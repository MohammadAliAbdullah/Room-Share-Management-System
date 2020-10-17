@extends('layouts.admin')
@section('content')
<div class="container">
 <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('admin/dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">ADMIN Dashboard</li>
  </ol>
@include('partial.message')
@include('partial.formerror')
 
  </div>
<div class="container" style="width:70%; margin:0 auto;">
 
<h3>Manage User </h3>
<div class="pull-right" style="margin-bottom:30px;">
                <a class="btn btn-success" href="{{ url('admin/user/create') }}"> Create New User</a>
</div>

<table class="table table-condensed table-responsive" >
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th> 
            
            <th>Action</th>
        </tr>
    @foreach ($users as $user)
    <tr>
        <td>{{ ($loop->index + 1) }}</td>
        <td>{{ $user->id}}</td>
        <td>{{ $user->name}}</td>
        <td>{{ $user->email}}</td>
        <td>{{ $user->email_verified_at}}</td>
        
        <td>
           
            <a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}">Edit</a>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => [
                    'user.destroy',
                     $user->id
                     ],
                'style'=>'display:inline',
                'onsubmit' => 'return confirm("are you sure ?")'
                ]) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            <a class="btn btn-info" href="{{ route('user.show',$user->id) }}">Show</a>
            
        </td>
    </tr>
    @endforeach
    </table>
{!! $users->links() !!}
</div>
@endsection

