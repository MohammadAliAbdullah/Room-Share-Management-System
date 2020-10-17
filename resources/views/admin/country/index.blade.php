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
 
<h3>Manage Country </h3>
<div class="pull-right" style="margin-bottom:30px;">
                <a class="btn btn-success" href="{{ url('admin/country/create') }}"> Create New Country</a>
</div>

<table class="table table-condensed table-responsive" >
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Name</th>
            <th>Code</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    @foreach ($countries as $country)
    <tr>
        <td>{{ ($loop->index + 1) }}</td>
        <td>{{ $country->id}}</td>
        <td>{{ $country->name}}</td>
        <td>{{ $country->code}}</td>
        <td>@if($country->status == "1")
            <span class="text-success">Active</span>
            @else
            <span class="text-warning">Inactive</span>
            @endif</td>
        
        
        <td>
            <a class="btn btn-info" href="{{ route('country.show',$country->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('country.edit',$country->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['country.destroy', $country->id],'style'=>'display:inline','onsubmit' => 'return confirm("are you sure ?")']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
{!! $countries->links() !!}
</div>
@endsection

