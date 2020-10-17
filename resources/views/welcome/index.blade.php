@extends('layouts.user')
@section('style')
<style>
  .badgebox{ display:none;}
  .badgebox + .badge
  {
      opacity: 0;
      width: 27px;
  }
  .badgebox:focus + .badge
  {
      box-shadow: inset 0px 0px 5px;
  
  }
  .badgebox:checked + .badge
  {
      /* Move the check mark back when checked */
      opacity: 100;
  }
  
  /*google map styles */
  #map {
          height: 300px;
          }
  </style>  
@endsection
@section('content')
<div class="container-fluid">    
  <div id="searchContainer" class="d-none">
<div class="s009">
  <form>
    <div class="inner-form">
      <div class="basic-search">
        <div class="input-field">
          <input id="search" type="text" placeholder="Type Keywords" />
        </div>
      </div>
      <div class="advance-search">
        <span class="desc">ADVANCED SEARCH</span>
        <div class="row">
          <div class="input-field">
            <div class="col">
              <select data-trigger="" name="cat" id="category" class="form-control">
                <option placeholder="" value="">Categories</option>
                @foreach ($categories as $k=>$category)
              <option value="{{$k}}">{{$category}}</option>                  
                @endforeach
              </select>
            </div>
          </div>
          <div class="input-field">
            <div class="col">
              <select data-trigger="" id="subcategory" name="scat" class="form-control">
                <option placeholder="" value="">Subcategories</option>          
              </select>
            </div>
          </div>
          <div class="input-field">
            <div class="input-select">
              <select data-trigger="" name="am" class="form-control">
                <option placeholder="" value="0">Amenities</option>
                @foreach ($amenities as $k=>$amenity)
                <option value="{{$k}}">{{$amenity}}</option>                  
                  @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="row second">
          <div class="input-field">
            <div class="col">
              <select data-trigger="" name="c" id="countries" class="form-control">
                <option placeholder="" value="">Country</option>
                @foreach ($countries as $k=>$country)
              <option value="{{$k}}">{{$country}}</option>                  
                @endforeach
              </select>
            </div>
          </div>
          <div class="input-field">
            <div class="col">
              <select data-trigger="" name="s" id="states" class="form-control">
                <option placeholder="" value="">State</option>                
              </select>
            </div>
          </div>
          <div class="input-field">
            <div class="col">
              <select data-trigger="" name="city" id="cities" class="form-control">
                <option placeholder="" value="">City</option>
                <option>Subject b</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row third">
          <div class="input-field">
            <div class="result-count">
              <span>108 </span>results</div>
            <div class="group-btn">
              <a class="btn-delete" href="{{url('/')}}">RESET</a>
              <button class="btn-search">SEARCH</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
{{-- search box end --}}
  </div>
  <hr>
  <div class="row">
      <div class="col-md-8">
              <div id="contentContainer">
                  @php
                  $locations = [];
                  @endphp
                      @forelse ($rooms as $room)
                      @php
                      $row = [];
                      $row[] = (string) (int) $room->price;    
                      $row[] = $room->latitude;    
                      $row[] = $room->longitude; 
                      $row[] = $room->title; 
                      $row[] = $room->category_id; 
                      $locations[] = $row;   
                      @endphp
                         <div class="card">
                         <div class="card-header"><h4><a href="{{url('property/'.$room->id)}}">{{$room->title}}</a> by <a href="{{url('profile/'.$room->writer_id)}}">{{$room->writer->name}}</a></h4>
                          Listed in Category:{{$room->category->name}}, Subcategory: {{$room->subcategory->description}}, Country : {{$room->country->name}},State : {{$room->state->name}},City : {{$room->city->name}}
                        </div>
                              <div class="card-body">
                              <a href="{{url('user/bookroom/'.$room->id)}}" class="float-right btn btn-info">Book Now</a>
                              <p>Location: {{$room->latitude}},{{$room->longitude}}</p>
                              
                                  <p>{!! nl2br($room->description) !!}</p>
                                  @forelse($room->photos as $pic)
                                  <?php
                                  $imageinfo = pathinfo(url('/storage/postimages/'.$pic->name));
                                  //print_r($imageinfo);
                                  ?>
                                  <a href="{{url('/storage/postimages/'.$pic->name)}}" data-lightbox="imageset-{{$room->id}}">
                                      <img src="{{url('/storage/postimages/'.$imageinfo['filename']."_thumb.".$imageinfo['extension'])}}" alt="" width="120px">
                                  </a>
                              @empty
                              <em>No images listed</em>
                              @endforelse
                                  <hr>
                                  {{-- 
                              @forelse($room->amenities as $a)            
                              <button class="badge">{{$a->name}}</button>
                      
                              @empty
                              <em>No amenities listed</em>
                              @endforelse
                                       --}}
                                       <!-- <table class="table table-hover">
                                      <thead>
                                        <tr>
                                          <th scope="col">Facilities :</th>
                                      </tr>
                                      </thead>
                                      <tbody> -->
                                      <h4 scope="col">Facilities :</h4>
                                          @forelse($room->amenities as $a)
                                         
                                              <button class="btn btn-dark"> {{$a->name}} </button>
                                          @empty
                                          <em>No amenities listed</em>
                                          @endforelse
                                      <!-- </tbody>
                                    </table> -->
                                              <hr>
                         {{-- <button id="editBtn" rid="{{$room->id}}" type="button" class="btn btn-info">Edit</button>
                         <button id="deleteBtn" rid="{{$room->id}}" type="button" class="btn btn-info">Delete</button> --}}
                          </div> 
                          </div> 
                      @empty
                        <h3>No post found from you. Create a new room</h3>  
                      @endforelse
                      {{$rooms->links()}} 
                      </div>
      </div>
      <div class="col-md-4">
              <div id="map" style="width:100%; height: 400px;"></div>
      </div>
  </div><!-- row class end-->  
</div>
@endsection
@section('script')
<script>
  var locations = {!!json_encode($locations)!!};
  var map;
          /*
var locations = [["room at IDB Bhaban","23.778578409737563","90.37932769444274"],["Beautiful Room for 1 person at Kalabagan","23.749012840812362","90.3792311349182"],["Room 001_shakil","23.78691022021746","90.37646309521483"],["3 Bed in Mirpur   --Fahim","23.807211102680437","90.36873833325194"],["Room in Uttara  --Fahim","23.87692457220888","90.39103285458373"],["Room In Dhaha Gulshan -- Fahim","23.780332368232063","90.41249052670287"],["Room In Dhaka -- Fahim","23.783523158893853","90.37852303173827"],["Budget Hotel near Airport (Hotel De Meridian Ltd)","23.830394205496475","90.46289459851073"],["Apartment in Lost Panorama","23.816840150682754","90.35722629216002"],["Flora & Fauna (now with Kitchen!)","23.78838282804896","90.37554041531371"]];
  */
function initMap() {
  //console.log(locations);
  map = new google.maps.Map(document.getElementById('map'), {
zoom: 12,
center: new google.maps.LatLng(23.786789, 90.376981),
mapTypeId: google.maps.MapTypeId.ROAD
});
var marker, i;
for (i = 0; i < locations.length; i++) { 
  var infowindow = new google.maps.InfoWindow(); 
marker = new google.maps.Marker({
  position: new google.maps.LatLng(locations[i][1], locations[i][2]),
  map: map,
  //label: locations[i][0],
  icon: 'images/'+locations[i][4]+'.png'
});
//marker.addListener('click', toggleBounce);
//infowindow.setContent(locations[i][0].toString());
//infowindow.open(map, marker);
google.maps.event.addListener(marker, 'click', (function(marker, i) {
  return function() {
    infowindow.setContent(locations[i][3].toString() + " @ " + locations[i][0]);
    infowindow.open(map, marker);
    //toggleBounce(marker);
  }
})(marker, i));
}
function toggleBounce(marker) {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}
}
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCe6-2NR2lqdZFfp7wuqAa9PiJg8PV1HJA&callback=initMap">
</script>
<script>
$(document).ready(function () {
$("#topSBtn").click(function(){
  if($("#searchContainer").hasClass('d-none')){
$("#searchContainer").removeClass('d-none');}
else{$("#searchContainer").addClass('d-none');}
});
});
</script>
<script>
$(document).ready(function(){


jQuery("#category").change(function(){
var url = "{{URL::to('/')}}";
$('#subcategory').empty();
var catid = $(this).val();
var url = "{{URL::to('/')}}";

$.ajax({
  type: "GET",
  url: url + '/selectsubcat/'+catid,
  data:{},
  dataType: "JSON",
  success:function(data) {
      console.log(data);
          if(data){
             // $('#subcategory').empty();

              $.each(data, function(key, value){
                  // alert(value.description);
                  $('#subcategory').append('<option value="'+value.id+'">' + value.description + '</option>');

              });
          }

      },
});

});
//category end


$("#countries").change(function(){
$('#states').empty();
$('#cities').empty();
 var country = $(this).val();
 var url = "{{URL::to('/')}}";

 //console.log(country);
 $.ajax({
     type: "GET",
     url: url + '/selectstate/'+country,
     data:{},
     dataType: "JSON",
     success:function(data) {
      console.log(data);
             if(data){
                 $.each(data, function(key, value){
                     $('#states').append('<option value="'+value.id+'">' + value.name + '</option>');

                 });
             }
         },
 });

});


$("#states").change(function(){

var state = $(this).val();
var url = "{{URL::to('/')}}";

//console.log(country);
$.ajax({
type: "GET",
url: url + '/selectcity/'+state,
data:{},
dataType: "JSON",
success:function(data) {
      if(data){
          $('#cities').empty();

          $.each(data, function(key, value){
             // alert(key);
              $('#cities').append('<option value="'+value.id+'">' + value.name + '</option>');

          });
      }

  },
});

});

}) ;     
</script>
    
@endsection


        