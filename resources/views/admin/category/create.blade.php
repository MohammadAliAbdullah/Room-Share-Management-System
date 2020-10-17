@extends('layouts.admin');
@section('css')

@endsection
@section('content')
<div class="container" style="width:70%; margin:0 auto;">
<h2>Category Form</h2>
@include('partial.message')
@include('partial.formerror')
    {!! Form::open(array('route' => 'category.store','method'=>'POST')) !!}
         @include('admin.category.form')
    {!! Form::close() !!}
</div>
@endsection
@section('script')
{{-- <script src="{{asset('js/bootstrap-switch.min.js')}}"></script> --}}
<script type="text/javascript">
    /*
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    });
    */
    </script>

@endsection
