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
 
<h3>Manage Amenities </h3>
<div class="pull-right" style="margin-bottom:30px;">
                <a class="btn btn-success" href="{{ url('admin/amenities/create') }}"> Create New Amenities</a>
</div>

<table class="table table-condensed table-responsive" >
        <tr>
          <th>No</th>
          <th>ID</th>
          <th>Name</th>
          <th>Image</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        @foreach ($amenities as $ameniti)
        
        <tr>
          <td>{{ ($loop->index + 1) }}</td>
          <td>{{ $ameniti->id}}</td>
          <td>{{ $ameniti->name}}</td>
          
          <td><img src="{{url('/images/amenities/'.$ameniti->icon_image)}}" class='rounded' width="80px;" height="50px;" alt="image not found"></td>
          <td>{{ $ameniti->status}}</td>
          
          <td>
    

            <a class="btn btn-primary" href="{{ route('amenities.edit',$ameniti->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['amenities.destroy', $ameniti->id],'style'=>'display:inline','onsubmit' => 'return confirm("are you sure ?")']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
{!! $amenities->links() !!}
</div>
@endsection

