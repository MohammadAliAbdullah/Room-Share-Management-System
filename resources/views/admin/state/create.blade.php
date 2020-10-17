@extends('layouts.admin');
@section('content')
<div class="container" style="width:70%; margin:0 auto;">
<h2>State Form</h2>
@include('partial.message')
@include('partial.formerror')
    {!! Form::open(array('route' => 'state.store','method'=>'POST')) !!}
         @include('admin.state.form')
    {!! Form::close() !!}
</div>
@endsection
