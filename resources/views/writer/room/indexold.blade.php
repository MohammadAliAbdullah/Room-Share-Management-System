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
 /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
       #map {
        height: 300px;
      }      
</style>
@endsection
@section('content')
<h3>Room management</h3>
{{-- <p>{{storage_path()}}</p> --}}
<div class="float-right">
    <input type="search" id="searchTxt" class="form-control-sm">
    <input type="button" value="Search" id="searchBtn" class="btn btn-secondary">
    <input type="button" value="Clear" id="clrSearchBtn" class="btn btn-secondary">
    </div>
    
<div id="formContainer">
{!! Form::open(['url' => 'writer/room/create','id'=>'createForm']) !!}
{!! Form::hidden('roomid','', ['id' => 'roomid']) !!}
{!! Form::label('roomtitle', 'Room Title', ['class' => 'awesome']) !!}
{!! Form::text('title','',['id'=>'roomtitle','class'=>'form-control','placeholder'=>'Room Title']) !!}
{!! Form::label('roomdesc', 'Room Description', ['class' => 'awesome']) !!}	
{!! Form::textarea('description','',['id'=>'roomdesc','class'=>'form-control','placeholder'=>'Room Description']) !!}
<label for="post-images" title="Upload Images" class="">
        <img style="cursor:pointer" src="{{asset('images/image-upload24x24.png')}}" alt="" title="Upload Images">
</label>
{!! Form::file('photos[]',['id'=>'post-images','class'=>'d-none','multiple','accept'=>'image/gif, image/jpeg, image/png']) !!}
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="form-group">
            <div class="preview"></div>
        </div>

    </div>
</div>
<hr>
<h3>Amenities</h3>
@foreach ($amenities as $k=>$v)
<label for="a{{$k}}" class="btn btn-primary">{{$v}}{{Form::checkbox("amenity[]",$k ,false, [ "class" => "badgebox ml-2","id"=>'a'.$k])}}<span class="badge badge-light">&check;</span>
</label>
{{-- <label for="a{{$k}}">
    {{$v}}{{Form::checkbox("amenity[]",$k ,false, [ "class" => "badgebox","id"=>'a'.$k])}}
    </label> --}}
@endforeach
<hr>
<h3>Location of your Property</h3>
<div id="map"></div>
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
            $imageinfo = pathinfo(url('/storage/postimages/'.$pic->name));
            //print_r($imageinfo);
            ?>
            <a href="{{url('/storage/postimages/'.$pic->name)}}" data-lightbox="imageset-{{$room->id}}">
                <img src="{{url('/storage/postimages/'.$imageinfo['filename']."_thumb.".$imageinfo['extension'])}}" alt="" width="120px">
            </a>

        @empty
        <em>No images listed</em>
        @endforelse

        @forelse($room->amenities as $a)            
        <span class="badge">{{$a->name}}</span>

        @empty
        <em>No amenities listed</em>
        @endforelse
                
            
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
        //header for csrf-token is must in laravel 
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        //

        $("#formContainer").hide();
        $("#newBtn").click(function(){
            clearform();
            $("#newBtn").hide(100);
            $("#formContainer").show(300);
            
        });
        $("#formCloseBtn").click(function(){
            $("#formContainer").hide(200);
            $("#newBtn").show(100);
            clearform();
        });

        

	    var url = "{{URL::to('/')}}";
        $("#addBtn").click(function(){
            //create Room
            if($(this).val() == 'Create'){
                var form_data = new FormData();
                for(var i=0, len=storedFiles.length; i<len; i++) {
                			form_data.append('photos[]', storedFiles[i]);
                		}
            form_data.append("title", $("#roomtitle").val());            
            form_data.append("description", $("#roomdesc").val()); 
            //amenities start
            var amenityIDs = $("#createForm input:checkbox:checked").map(function(){
            return $(this).val(); 
            }).get();
            //console.log(amenityIDs); return;
            form_data.append("amenities", amenityIDs); 
            //amenities end           
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
                $.ajax({
                url:url+'/writer/room/'+$("#roomid").val(),
                method: "PUT",
                type: "PUT",
                data:{
                    title: $("#roomtitle").val(),
                    description: $("#roomdesc").val()
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
                //console.log(d);
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
        function initMap() {
            //23.786816, 90.376996
          var myLatlng = {lat: 23.786816, lng: 90.376996};
  
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: myLatlng
          });
  
          var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'Click to zoom'
          });
  
          map.addListener('center_changed', function() {
            // 3 seconds after the center of the map has changed, pan back to the
            // marker.
            // window.setTimeout(function() {
            //   map.panTo(marker.getPosition());
            // }, 3000);
          });
  
          marker.addListener('click', function(e) {
            console.log(marker.getPosition())
            //map.setZoom(8);
            //map.setCenter(marker.getPosition());
          });
        }
      </script>
      <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCe6-2NR2lqdZFfp7wuqAa9PiJg8PV1HJA&callback=initMap">
      </script>
@endsection