<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
            
        $slug = $this->request->get("email");

        return [
                'name' => 'required',   
                'email' => ['required', Rule::unique('users')->ignore($slug,'email')],
                'roles' => 'required',
            ];

    }
}
