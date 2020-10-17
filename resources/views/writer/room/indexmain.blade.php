@extends('layouts.ownerblank')
@section('css')
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
<h3>Room management</h3>
<p>{{storage_path()}}</p>
<div class="float-right">
    <input type="search" id="searchTxt" class="form-control-sm">
    <input type="button" value="Search" id="searchBtn" class="btn btn-secondary">
    <input type="button" value="Clear" id="clrSearchBtn" class="btn btn-secondary">
    </div>

<div id="formContainer">
{!! Form::open(['url' => 'writer/room/create','id'=>'createForm']) !!}
{!! Form::hidden('roomid','', ['id' => 'roomid']) !!}
<div id="step1">
{{-- room category start --}}
<h3>Room Type</h3>
{!! Form::label('category', 'Category', ['class' => 'awesome']) !!}
{!! Form::select('category',$category,null,['class'=>'form-control','id'=>'category','placeholder'=>'Select Category', 'required']) !!}
<hr>
{!! Form::label('subcategory', 'Sub Category', ['class' => 'awesome']) !!}
<select name="subcategory" id="subcategory" class="form-control" "required">
    <option value="">Select subcategory</option>
</select>
{{-- room category end --}}
<button type="button" class="step2Btn">Next</button>
</div>{{-- step1 end end --}}
<div id="step2">
<h3>Room Information</h3>
{!! Form::label('roomtitle', 'Room Title', ['class' => 'awesome']) !!}
{!! Form::text('title','',['id'=>'roomtitle','class'=>'form-control','placeholder'=>'Room Title', 'required']) !!}
{!! Form::label('roomdesc', 'Room Description', ['class' => 'awesome']) !!}
{!! Form::textarea('description','',['id'=>'roomdesc','class'=>'form-control','placeholder'=>'Room Description', 'required']) !!}
{!! Form::label('price', 'Price', ['class' => 'awesome']) !!}
{!! Form::text('price','',['id'=>'price','class'=>'form-control','placeholder'=>'0.00', 'required']) !!}
<label for="post-images" title="Upload Images" class="">
        <img style="cursor:pointer" src="{{asset('images/image-upload24x24.png')}}" alt="" title="Upload Images">
</label>
{!! Form::file('photos[]',['id'=>'post-images','class'=>'d-none','multiple','accept'=>'image/gif, image/jpeg, image/png'], 'required') !!}
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="form-group">
            <div class="preview"></div>
        </div>

    </div>
</div>
<div class="row" id="imageContainer"></div>
<hr>
<h3>Amenities</h3>
@foreach ($amenities as $k=>$v)
<label for="a{{$k}}" class="btn btn-primary">{{$v}}{{Form::checkbox("amenity[]",$k ,false, [ "class" => "badgebox ml-2","id"=>'a'.$k])}}<span class="badge badge-light">&check;</span>
</label>
{{-- <label for="a{{$k}}">
    {{$v}}{{Form::checkbox("amenity[]",$k ,false, [ "class" => "badgebox","id"=>'a'.$k])}}
    </label> --}}
@endforeach
<br>
<button type="button" class="step1Btn">Previous</button>
<button type="button" class="step3Btn">Next</button>
</div>{{-- step2 end --}}
<hr>
<div id="step3">
<h3>Location</h3>
{!! Form::label('country', 'Country', ['class' => 'awesome']) !!}
{!! Form::select('country',$country,null,['class'=>'form-control','id'=>'countries','placeholder'=>'Select Country', 'required']) !!}
<hr>
{!! Form::label('state', 'State', ['class' => 'awesome']) !!}
<select name="state" id="states" class="form-control">
    <option value="">Select State</option>
</select>
<hr>
{!! Form::label('city', 'City', ['class' => 'awesome']) !!}
<select name="city" id="cities" class="form-control">
    <option value="">Select City</option>
</select>
<hr>
<div id="map"></div>
{!! Form::label('loclat', 'Latitude', ['class' => 'awesome']) !!}
{!! Form::text('loclat','',['id'=>'loclat','class'=>'form-control','placeholder'=>'Latitude','readonly']) !!}
{!! Form::label('loclng', 'Latitude', ['class' => 'awesome']) !!}
{!! Form::text('loclng','',['id'=>'loclng','class'=>'form-control','placeholder'=>'Longitude','readonly']) !!}
<button type="button" class="step2Btn">Previous</button>
</div>{{-- step3 end --}}

<hr>

<input type="button" id="addBtn" value="Create" class="btn btn-primary">
<input type="button" id="formCloseBtn" value="Close" class="btn btn-warning">
{!! Form::close() !!}
</div>
<button id="newBtn" type="button" class="btn btn-info">Add New Room</button>

<hr>
<div id="contentContainer">
@forelse ($rooms as $room)
   <div class="card">
        <div class="card-header">{{$room->title}}</div>
        <div class="card-body">
            <p>{!! nl2br($room->description) !!}</p>
            @forelse($room->photos as $pic)

            <?php
$imageinfo = pathinfo(url('/storage/postimages/' . $pic->name));
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
        <span class="badge">{{$a->name}}</span>

        @empty
        <em>No amenities listed</em>
        @endforelse
                 --}}
                 <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Facilities :</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($room->amenities as $a)
                <tr>
                <td>{{$a->name}}</td>
                 </tr>
                  @empty
                   <em>No amenities listed</em>
                                @endforelse
                                </tbody>
                        </table>
            <hr>
   <button id="editBtn" rid="{{$room->id}}" type="button" class="btn btn-info">Edit</button>
   <button id="deleteBtn" rid="{{$room->id}}" type="button" class="btn btn-info">Delete</button>
    </div>
    </div>
@empty
  <h3>No post found from you. Create a new room</h3>
@endforelse
{{$rooms->links()}}
</div>
@endsection
@section('script')
    <script>
    var storedFiles = [];
    $(document).ready(function () {
        $("#step1 ,#step2, #step3,#addBtn").hide();
        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        //

        $("#formContainer").hide();
        $("#newBtn").click(function(){
            clearform();
            $("#step1").show();
            $("#newBtn").hide(100);
            $("#formContainer").show(300);

        });
        $("#formCloseBtn").click(function(){
            $("#formContainer").hide(200);
            $("#newBtn").show(100);
            clearform();
        });

        $(".step2Btn").click(function(){
            $("#step3,#step1").hide();
            $("#step2").show();
        });
        $(".step1Btn").click(function(){
            $("#step2,#step3").hide();
            $("#step1").show();
        });
        $(".step3Btn").click(function(){
            $("#step1,#step2").hide();
            $("#step3, #addBtn").show();
        });var url = "{{URL::to('/')}}";
        $("#addBtn").click(function(){
            //create Room
            if($(this).val() == 'Create'){
                var form_data = new FormData();
                for(var i=0, len=storedFiles.length; i<len; i++) {
                			form_data.append('photos[]', storedFiles[i]);
                		}
            form_data.append("title", $("#roomtitle").val());
            form_data.append("description", $("#roomdesc").val());
            form_data.append("price", $("#price").val());
            form_data.append("country", $("#countries").val());
            form_data.append("state", $("#states").val());
            form_data.append("city", $("#cities").val());
            form_data.append("category", $("#categories").val());
            form_data.append("subcategory", $("#subcategory").val());
            form_data.append("latitude", $("#loclat").val());
            form_data.append("longitude", $("#loclng").val());

            //amenities start
            var amenityIDs = $("#createForm input:checkbox:checked").map(function(){
            return $(this).val();
            }).get();
           // console.log($("#countries").val()); return;
            form_data.append("amenities", amenityIDs);
            //amenities end
            //country
            $.ajax({
                url:url+'/writer/room',
                method: "POST",
                contentType: false,
                processData: false,
                data:form_data,
                success: function(d){
                    //console.log(d); return;
                    if(d.success) {
                        form_data = new FormData();
                        storedFiles=[];
                        alert(d.message);
                        location.reload();
                        }
                },
                error:function(d){
                    console.log(d);
                }
            });
            }
            //create Room end

            //Update Room
            if($(this).val() == 'Update'){
                var update_form_data = new FormData();
                update_form_data.append("_method", 'PUT');
                for(var i=0, len=storedFiles.length; i<len; i++) {
                    update_form_data.append('photos[]', storedFiles[i]);
                		}
                        update_form_data.append("title", $("#roomtitle").val());
                        update_form_data.append("description", $("#roomdesc").val());
                        update_form_data.append("price", $("#price").val());
            //amenities start
            var amenityIDs = $("#createForm input:checkbox:checked").map(function(){
            return $(this).val();
            }).get();
            //console.log(amenityIDs); return;
            update_form_data.append("amenities", amenityIDs);
            //console.log(form_data);
            //alert(5);
            //return;
                $.ajax({
                url:url+'/writer/room/'+$("#roomid").val(),
                method: "POST",
                type: "POST",
                contentType: false,
                processData: false,
                data:update_form_data,
                success: function(d){
                    if(d.success) {
                        update_form_data = new FormData();
                        storedFiles=[];
                        alert(d.message);
                        location.reload();
                        }
                },
                error:function(d){
                    console.log(d);
                }
            });
            }
            //Update Room end


        });
        //Edit Room
        $("#contentContainer").on('click','#editBtn', function(){
            //alert()
            $roomid = $(this).attr('rid');
            //console.log($roomid);
            $info_url = url + '/writer/room/'+$roomid+'/edit';
            $.get($info_url,{},function(d){
                console.log(d);
                populateForm(d);
                location.hash = "formContainer";
            });
        });
        //Edit Room end
        //Delete Room
        $("#contentContainer").on('click','#deleteBtn', function(){
            //alert()
            if(!confirm('Sure?')) return;
            $roomid = $(this).attr('rid');
            //console.log($roomid);
            $info_url = url + '/writer/room/'+$roomid;
            $.ajax({
                url:$info_url,
                method: "DELETE",
                type: "DELETE",
                data:{
                },
                success: function(d){
                    if(d.success) {
                        alert(d.message);
                        location.reload();
                        }
                },
                error:function(d){
                    console.log(d);
                }
            });
        });
        //Delete Room end
        //search
        $("#searchBtn").click(function(){
            $searchUrl = url + '/writer/search';
            $.post($searchUrl,{
                searchText: $("#searchTxt").val()
            },function(d){
//console.log(d);
populateSearchData(d);
            });
        });
        function populateSearchData(d){
            $h = '';
            d.forEach(data => {
               $h += '<div class="card"><div class="card-header">'+data.title+'</div><div class="card-body"><p>'+data.description+'</p><hr><button id="editBtn" rid="'+data.id+'" type="button" class="btn btn-info">Edit</button> <button id="deleteBtn" rid="'+data.id+'" type="button" class="btn btn-info">Delete</button></div></div>';
            });
            $("#contentContainer").html($h);

        }
        //search end
        function populateForm(data){
            $("#roomtitle").val(data.title);
            $("#roomdesc").val(data.description);
            $("#roomid").val(data.id);
            $amenities = data.amenities;
            $images = data.photos;
            //uncheck all checkbox first
            $("input.badgebox").prop('checked',false);
            $.each($amenities,function (k,v) {
                //console.log(v.name + " : "+ v.id);
                $("#a"+v.id).prop('checked',true);
            });
            //show all images
            $img_cont = '';
            $.each($images,function (k,v) {
                $i = v.name.split(".");
                $img_cont += '<img class="mr-2" src="{{url('/')}}/storage/postimages/'+$i[0]+ '_thumb.'+$i[1]+'">';
                //console.log(v.name + " : "+ v.id);
            });
            $("#imageContainer").html($img_cont);

            $("#addBtn").val('Update');
            $("#formContainer").show(300);
            $("#newBtn").hide(100);
        }
        function clearform(){
            $('#createForm')[0].reset();
            $("#addBtn").val('Create');
        }
        $("#clrSearchBtn").click(function(){
location.reload();
        });
        /* WHEN YOU UPLOAD ONE OR MULTIPLE FILES */
        $(document).on('change','#post-images',function(){
                //$('.preview').html("");
                len_files = $("#post-images").prop("files").length;
                var construc = "<div class='row'>";
                for (var i = 0; i < len_files; i++) {
                    var file_data = $("#post-images").prop("files")[i];
                    storedFiles.push(file_data);
                    //console.log(file_data);
                    //form_data.append("photos[]", file_data);
                    //TODO: work on delete image btn in file upload
                    construc += '<div class="col-3 singleImage my-3"><span data-file="'+file_data.name+'" class="btn ' +
                     'btn-sm btn-danger imageremove">&times;</span><img width="120px" height="auto" src="' +  window.URL.createObjectURL(file_data) + '" alt="'  +  file_data.name  + '" /></div>';
                }
                construc += "</div>";
                $('.preview').append(construc);
            });

            $(".preview").on('click','span.imageremove',function(){
                //console.log($(this).next("img"));
                //console.log($(this).next("img"));
                var trash = $(this).data("file");
                for(var i=0;i<storedFiles.length;i++) {
                			if(storedFiles[i].name === trash) {
                				storedFiles.splice(i,1);
                				break;
                			}
                		}
                		$(this).parent().remove();

            });
    });
    </script>
    <script>
        var map, infoWindow;
        function initMap() {
            //23.786789, 90.376981
          var myLatlng = {lat: 23.786789, lng: 90.376981};

          map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: myLatlng
          });
          //infoWindow = new google.maps.InfoWindow;
          // Try HTML5 geolocation.
if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            //infoWindow.setPosition(pos);
            //infoWindow.setContent('Location found.');
            //infoWindow.open(map);
            map.setCenter(pos);
            var marker = new google.maps.Marker({
                    position: pos,
                    draggable:true,
                    title:"Position Your Place Precisely",
                    map: map
                });
                google.maps.event.addListener(marker, 'dragend', function(ev){
    //alert(map.lat() + ' ' + map.lng()); // always the same LatLng-Object...
    var pos = marker.getPosition(); // new LatLng-Object after dragend-event...
    //console.log(pos.toJSON());
    var l = pos.toJSON();
    //alert(l.lat);
    $("#loclat").val(l.lat);
    $("#loclng").val(l.lng);
});
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
        //   google.maps.event.addListener(map, 'click', function(event) {
        //     placeMarker(event.latLng);
        //     });

        //     function placeMarker(location) {
        //         //console.log(location.lat);
        //         var marker = new google.maps.Marker({
        //             position: location,
        //             map: map
        //         });
        //         console.log()
        //     }
        }
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
      </script>
      <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCe6-2NR2lqdZFfp7wuqAa9PiJg8PV1HJA&callback=initMap">
      </script>

      <script>
      $(document).ready(function () {
        $("#countries").change(function(){

 $('#states').empty();
 $('#cities').empty();
        var country = $(this).val();
        var url = "{{URL::to('/')}}";

        //console.log(country);
        $.ajax({
            type: "GET",
            url: url + '/getstate/'+country,
            data:{},
            dataType: "JSON",
            success:function(data) {
                    if(data){
                        $('#states').empty();

                        $.each(data, function(key, value){
                           // alert(key);
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
    url: url + '/getcity/'+state,
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
      });
      </script>

      {{-- category task start --}}
       <script>
        $(document).ready(function () {
          $("#category").change(function(){
   $('#subcategory').empty();
          var catid = $(this).val();
          var url = "{{URL::to('/')}}";

          $.ajax({
              type: "GET",
              url: url + '/getsubcategory/'+catid,
              data:{},
              dataType: "JSON",
              success:function(data) {
                  console.log(data);
                      if(data){
                          //$('#subcategory').empty();

                          $.each(data, function(key, value){
                             // alert(key);
                              $('#subcategory').append('<option value="'+value.id+'">' + value.name + '</option>');

                          });
                      }

                  },
          });

  });

        });
        </script>
@endsection