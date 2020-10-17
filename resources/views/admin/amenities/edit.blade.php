@extends('layouts.admin')
@section('content')
  <div class="container" style="width:70%; margin:0 auto;">
    <div class="row">
  
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Category</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('amenities.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @include('partial.message')
    @include('partial.formerror')


    {!! Form::model($amenities, ['method' => 'PATCH','route' => ['amenities.update',
    $amenities->id]]) !!}
        @include('admin.amenities.form')
    {!! Form::close() !!}

</div>
@endsection