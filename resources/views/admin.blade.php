@extends('layouts.auth')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        Hi boss! Admin Blade. <a href="{{url('admin/dashboard')}}">Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection