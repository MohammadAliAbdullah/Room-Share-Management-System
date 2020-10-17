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
 
<h3>Manage Subcategory </h3>
<div class="pull-right" style="margin-bottom:30px;">
                <a class="btn btn-success" href="{{ url('admin/subcategory/create') }}"> Create New Subcategory</a>
</div>
<table class="table table-condensed table-responsive" >
        <tr>
            <th>ID</th>
            <th>Category</th>            
            <th>Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    @foreach ($subcategories as $subcategory)
    <tr>
         <td>{{ $subcategory->id}}</td>
         <td>{{ $subcategory->category->name}}</td>
        <td>{{ $subcategory->description}}</td>
        <td>
            @if($subcategory->status == "1")
            <span class="text-success">Active</span>
            @else
            <span class="text-warning">Inactive</span>
            @endif

        </td>
        
        <td>
            <a class="btn btn-info" href="{{ route('subcategory.show',$subcategory->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('subcategory.edit',$subcategory->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['subcategory.destroy', $subcategory->id],'style'=>'display:inline','onsubmit' => 'return confirm("are you sure ?")']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
{!! $subcategories->links() !!}
</div>
@endsection

