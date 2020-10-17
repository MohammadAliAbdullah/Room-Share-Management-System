@extends('layouts.app')
@section('content')
@if($profile)
<div class="row">
    <div class="col-9">
        {{$profile->title}} <hr>
{{$profile->description}}
    </div>
    <div class="col-3">
    <img class="img-fluid" src="{{asset('storage/opi/'.$profile->image)}}" title="{{$profile->writer->name}}">
    </div>
</div>


@else
 <h3>no profile found</h3>   
@endif
    
@endsection