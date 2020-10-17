@extends('layouts.admin');
@section('content')
<div class="container" style="width:70%; margin:0 auto;">
<h2>Country Form</h2>
@include('partial.message')
@include('partial.formerror')
    {!! Form::open(array('route' => 'country.store','method'=>'POST')) !!}
         @include('admin.country.form')
    {!! Form::close() !!}
</div>
@endsection
