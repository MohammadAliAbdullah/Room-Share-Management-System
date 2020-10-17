@extends('layouts.admin');
@section('content')
<div class="container" style="width:70%; margin:0 auto;">
<h2>Subcategory Form</h2>
@include('partial.message')
@include('partial.formerror')
    {!! Form::open(array('route' => 'subcategory.store','method'=>'POST')) !!}
         @include('admin.subcategory.form')
    {!! Form::close() !!}
</div>
@endsection
