<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendRegisterEmailJob;
use App\Mail\SendRegisterEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    protected function register(Request $request)
    {
        $userDetails = new User();
        $userDetails->name = $request->name;
        $userDetails->email = $request->email;
        $userDetails->password = Hash::make($request->password);
        $userDetails->save();

        $emaiId = $userDetails->email;

        // dd($emaiId);
        dispatch(new SendRegisterEmailJob($emaiId));
        // $this->dispatch(new SendRegisterEmailJob($emaiId));
        return view('auth.login')->with('success','User created successfully');
    }

}
