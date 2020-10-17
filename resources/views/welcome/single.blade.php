@extends('layouts.user')
@section('style')
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> 
@endsection
@section('content')
<div class="row">
    <div class="col-md-8">
            <div id="contentContainer">




<div class="card">
<div class="card-header"><h4>{{$room->title}}</h4></div>
     <div class="card-body">
            @forelse($room->photos as $pic)
            <?php
            $imageinfo = pathinfo(url('/storage/postimages/'.$pic->name));
            //print_r($imageinfo);
            ?>
            <a href="{{url('/storage/postimages/'.$pic->name)}}" data-lightbox="imageset-{{$room->id}}">
                <img src="{{url('/storage/postimages/'.$imageinfo['filename']."_thumb.".$imageinfo['extension'])}}" alt="" width="220px">
            </a>
        @empty
        <em>No images listed</em>
        @endforelse

     <p>Location: {{$room->latitude}},{{$room->longitude}}</p>

         <p>{!! nl2br($room->description) !!}</p>

         <hr>
         {{--
     @forelse($room->amenities as $a)
     <span class="badge">{{$a->name}}</span>

     @empty
     <em>No amenities listed</em>
     @endforelse
              --}}

                 <h3>Facilities :</h3>

                 @forelse($room->amenities as $a)

                    {{$a->name}}, &nbsp;

                 @empty
                 <em>No amenities listed</em>
                 @endforelse
  <br>
  <hr>
                     <a href="{{url('user/bookroom/'.$room->id)}}" class="float-left btn btn-info">Book Now</a>
{{-- <button id="editBtn" rid="{{$room->id}}" type="button" class="btn btn-info">Edit</button>
<button id="deleteBtn" rid="{{$room->id}}" type="button" class="btn btn-info">Delete</button> --}}
 </div>







</div>
</div>
<div class="card mt-3">
<div class="card-header"><h3>Reviews</h3></div>
 <div class="card-body">
 
 <form action="">
 <label for="comment" class="control-label">Comment</label>
 <input type="hidden" name="" id="room" value="{{$room->id}}">
 <textarea id="userreview"></textarea>


<label for="input-1" class="control-label">Accuracy:</label>
<input id="input-1" value="0" type="text" class="rating" data-min=0 data-max=5 data-step=1 data-size="sm"
   title="">
   <label for="input-2" class="control-label">Location:</label>
<input id="input-2" value="0" type="text" class="rating" data-min=0 data-max=5 data-step=1 data-size="sm"
   title="">
   <label for="input-3" class="control-label">Communication:</label>
<input id="input-3" value="0" type="text" class="rating" data-min=0 data-max=5 data-step=1 data-size="sm"
   title="">
   <label for="input-21d" class="control-label">Checkin:</label>
<input id="input-4" value="0" type="text" class="rating" data-min=0 data-max=5 data-step=1 data-size="sm"
   title="">
   <label for="input-5" class="control-label">Cleanliness:</label>
<input id="input-5" value="0" type="text" class="rating" data-min=0 data-max=5 data-step=1 data-size="sm"
   title="">
   <button type="button" id="submit" class="btn btn-primary">Submit</button>


 </form>
 
 <div class="card-body">
 <ul class="list-unstyled">
 @foreach($room->reviews as $review)
 <li class="media">

    <img class="d-flex mr-3" src="{{ asset('images/users/3.jpg') }}" width="60" alt="Generic placeholder image">
    <div class="media-body">
        <h4 class="mt-0 mb-1 text-info">{{$review->user->name}}</h4>
        {{$review->comment}}

        
                  </div>
              </li>
              @endforeach
 </ul>
 </div>



 </div>
</div><!-- review card end -->


</div><!-- row class end-->
<div class="col-md-4">
<div class="card">
    <div class="card-header"><h4>Owner's Details</h4></div>
         <div class="card-body">
                <h4>{{$room->writer->name}}</h4>
                @if(@$room->writer->profile)
                <img style="height:150px" src="{{asset('storage/opi/'.$room->writer->profile->image)}}" alt="">
                <br>
                <br>
                <h4>About me:</h4>

                <h5>{{$room->writer->profile->title}}</h5>
                <p>{{$room->writer->profile->description}}</p>
                <h6><span style="font-weight: bold"> School :</span> {{$room->writer->profile->school}}</h6>
                <h6><span style="font-weight: bold"> Occupation :</span> {{$room->writer->profile->work}}</h6>
                <h6><span style="font-weight: bold"> Language :</span> {{$room->writer->profile->languages}}</h6>
                <h6><span style="font-weight: bold"> Since :</span> {{$room->writer->profile->created_at->year}}</h6>
                @else
                <h3>Profile not found</h3>
                @endif
         </div>
</div>


</div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/star-rating.min.js') }}"></script>
<script src="{{ asset('js/jquery-te-1.4.0.min.js') }}"></script>
<script>
    $(document).ready(function () {
        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //
            var url = "{{URL::to('/')}}";
        $("textarea").jqte();
        $('#submit').click(function(e){
            //alert($('#input-1').val())
            //ajax submit start
                var form_data = new FormData();
    
                form_data.append("room_id", $("#room").val());
                form_data.append("review", $("#userreview").val());
                form_data.append("accuracy", $("#input-1").val());
                form_data.append("location", $("#input-2").val());
                form_data.append("communication", $("#input-3").val());
                form_data.append("checkin", $("#input-4").val());
                form_data.append("cleanliness", $("#input-5").val());
                
    
                $.ajax({
                    type: "POST",
                    url: url+'/user/review',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(d){
                        //console.log(d.status);
                        if(d.success) {        
                            swal("Success" , d.message);                        
                            location.reload();
                            }
                    },
                    error:function(d){
                        console.log(d);
                        swal("Error!", d.statusText + ". Please Register Or Login");                   
                        //swal(d.status);
                    }
                });
                
        })
        
    
        
    });
    
    </script>
     
@endsection
