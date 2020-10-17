@extends('layouts.app')
@section('content')
@if($profile)

<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-sm-4">                        
                        <div class="profile-img" style="overflow-y: hidden">
                            <img src="{{asset('storage/opi/'.$profile->image)}}" title="{{$profile->writer->name}}" class="rounded-circle">
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="profile-head">
                                    <h5>
                                    {{$profile->title}}
                                    </h5>
                                    <p class="proile-rating">RANKINGS : <span> 8/10 </span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Review</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="profile-work">
                            <p>WORK LINK</p>
                            <a href="">Website Link</a><br/>
                            <a href="">Bootsnipp Profile</a><br/>
                            <a href="">Bootply Profile</a>
                            <p>SKILLS</p>
                            <a href="">Web Designer</a><br/>
                            <a href="">Web Developer</a><br/>
                            <a href="">WordPress</a><br/>
                            <a href="">WooCommerce</a><br/>
                            <a href="">PHP, .Net</a><br/>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>{{$profile->writer_id}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>{{$profile->writer->name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>{{$profile->writer->email}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>{{$profile->phone}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Profession</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>Web Developer and Designer</p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>School Name</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>{{$profile->school}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Work</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>{{$profile->work}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Languages</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>{{$profile->languages}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>English Level</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>Expert</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Availability</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>6 months</p>
                                            </div>
                                        </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Your Bio</label><br/>
                                        <p>{{$profile->description}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>{{$profile->writer_id}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>{{$profile->writer->name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>{{$profile->writer->email}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>{{$profile->phone}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Profession</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>Web Developer and Designer</p>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>
    
    


@else
 <h3>no profile found</h3>   
@endif
    
@endsection