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
 
<h3>Manage State </h3>
<div class="pull-right" style="margin-bottom:30px;">
                <a class="btn btn-success" href="{{ url('admin/state/create') }}"> Create New State</a>
</div>

<table class="table table-condensed table-responsive" >
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>State Name</th>
            <th>State Code</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    @foreach ($states as $state)
    <tr>
        <td>{{ ($loop->index + 1) }}</td>
        <td>{{ $state->id}}</td>
        <td>{{ $state->name}}</td>
        <td>{{ $state->code}}</td>
        <td>@if($state->status == "1")
            <span class="text-success">Active</span>
            @else
            <span class="text-warning">Inactive</span>
            @endif</td>
        
        <td>
            <a class="btn btn-info" href="{{ route('state.show',$state->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('state.edit',$state->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['state.destroy', $state->id],'style'=>'display:inline','onsubmit' => 'return confirm("are you sure ?")']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
{!! $states->links() !!}
</div>
@endsection

