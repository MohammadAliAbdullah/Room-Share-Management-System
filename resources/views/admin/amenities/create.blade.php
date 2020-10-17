@extends('layouts.admin');
@section('content')
<div class="container" style="width:70%; margin:0 auto;">
<h2>Amenities Form</h2>
@include('partial.message')
@include('partial.formerror')
    {!! Form::open(array('route' => 'amenities.store','method'=>'POST','files'=>true)) !!}
         @include('admin.amenities.form')
    {!! Form::close() !!}
</div>
@endsection
