@extends('layouts.admin')
@section('content')
<div class="container">
 <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('admin/dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">ADMIN Dashboard</li>
  </ol>
  </div>
<div class="container" style="width:70%; margin:0 auto;">
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show shift Info</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('shift.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Shift Name:</strong>
                {{ $shift->name}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Shift Code:</strong>
                    {{ $shift->code}}
                </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Start Time:</strong>
                {{ $shift->start_time}}
            </div>
        </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>End Time:</strong>
                {{ $shift->end_time}}
            </div>
        </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Note:</strong>
                {{ $shift->note}}
            </div>
        </div>
        
       
       
    </div>
    </div>
@endsection
