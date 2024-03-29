@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        @role('Admin')
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
        </div>
        @endrole
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Roles</th>
        <th width="280px">Action</th>
    </tr>

    @role('Admin')
        @foreach ($usersData as $key => $user)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
               {{ $v }}
                @endforeach
            @endif
            </td>
            <td>
            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
            @if($userRole == "Admin")
                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
                @endif
            </td>
        </tr>
        @endforeach
    @else
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ Auth::user()->name }}</td>
            <td>{{ Auth::user()->email }}</td>
            <td>
            @if(!empty(Auth::user()->getRoleNames()))
                @foreach(Auth::user()->getRoleNames() as $v)
                {{ $v }}
                @endforeach
            @endif
            </td>
            <td>
            <a class="btn btn-info" href="{{ route('users.show',Auth::user()->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('users.edit',Auth::user()->id) }}">Edit</a>
            </td>
        </tr>
    @endrole
</table>




@endsection