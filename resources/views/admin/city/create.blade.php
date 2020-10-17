@extends('layouts.admin');
@section('content')
<div class="container" style="width:70%; margin:0 auto;">
<h2>City Form</h2>
@include('partial.message')
@include('partial.formerror')
    {!! Form::open(array('route' => 'city.store','method'=>'POST')) !!}
         @include('admin.city.form')
    {!! Form::close() !!}
</div>
@endsection
