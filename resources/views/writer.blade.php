@extends('layouts.auth')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                    Hi there, awesome writer. GO to <a href="{{url('writer/dashboard')}}">Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection