@extends('layouts.admin')
@section('content')
  <div class="container" style="width:70%; margin:0 auto;">
    <div class="row">
  
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Subcategory</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('subcategory.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @include('partial.message')
    @include('partial.formerror')


    {!! Form::model($subcategory, ['method' => 'PATCH','route' => ['subcategory.update',
    $subcategory->id]]) !!}
        @include('admin.subcategory.form')
    {!! Form::close() !!}

</div>
@endsection