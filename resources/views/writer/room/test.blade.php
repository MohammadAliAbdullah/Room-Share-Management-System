@extends('layouts.newownerblank')
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
                <!-- Validation wizard -->
                <div class="row" id="validation">
                    <div class="col-12">
                        <div class="card wizard-content">
                            <div class="card-body" id="formContainer">
                                <h4 class="card-title">Step wizard with validation</h4>
                                <h6 class="card-subtitle">You can us the validation like what we did</h6>
                                {!! Form::open(['url' => 'writer/room/create','id'=>'createForm','class' =>'validation-wizard wizard-circle']) !!}
{!! Form::hidden('roomid','', ['id' => 'roomid']) !!}

                                    <!-- Step 1 -->
                                    <h6>Step 1</h6>
                                    <section>

                                        <div class="row justify-content-md-center">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="category"> What type of property do you have?<span class="danger"></span> </label>
                                                    {!! Form::select('category',$category,null,['class'=>'custom-select form-control required','id'=>'category','placeholder'=>'Select One',]) !!}
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row justify-content-md-center">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="subcategory">Choose a property type<span class="danger"></span> </label>
                                                    <select class="custom-select form-control required" id="subcategory" name="subcategory">
                                                    <option value="">Select One</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>


                                    </section>
                                    <!-- Step 2 -->
                                    <h6>Step 2</h6>
                                    <section>

                                    <div class="row justify-content-md-center">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jobTitle2">How many guests can stay comfortably?</label>
                                                    <input type="text" class="form-control required" id="accomodates_count">
                                                </div>
                                            </div>
                                            </div>
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <label for="wint1">How many bedrooms can guests use?</label>
                                                    <input type="text" class="form-control required" id="bedroom_count"> </div>
                                        </div>
                                        </div>
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <label for="wint1">How many beds can guests use?</label>
                                                    <input type="text" class="form-control required" id="bed_count"> </div>
                                        </div>
                                        </div>
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <label for="wint1">How many bathroom can guests use?</label>
                                                    <input type="text" class="form-control required" id="bathroom_count"> </div>
                                        </div>
                                        </div>
                                    </section>
                                    <!-- Step 3 -->
                                    <h6>Step 3</h6>
                                    <section>
                                    <div class="row justify-content-md-center">
                                    <div class="col-md-6" id="map"></div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                    <label for="wlocation2">Latitude<span class="danger"></span> </label>
{!! Form::text('loclat','',['id'=>'loclat','class'=>'custom-select form-control required','placeholder'=>'Latitude','readonly']) !!}
<label for="wlocation2">Longitude<span class="danger"></span> </label>
{!! Form::text('loclng','',['id'=>'loclng','class'=>'custom-select form-control required','placeholder'=>'Longitude','readonly']) !!}

                                    </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wlocation2">Country<span class="danger"></span> </label>
                                                    {!! Form::select('country',$country,null,['class'=>'custom-select form-control required','id'=>'countries','placeholder'=>'Select Country']) !!}
                                                </div>
                                            </div>
                                            </div>
                                            <div class="row justify-content-md-center">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wlocation2">State<span class="danger"></span> </label>
                                                    <select name="state" id="states" class="custom-select form-control required"><option value="">Select State</option>
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wlocation2">City<span class="danger"></span> </label>
                                                    <select name="city" id="cities" class="custom-select form-control required"><option value="">Select City</option>
                                                    </select>
                                                </div>
                                            </div>
                                    </div>

                                    </section>
                                    <!-- Step 4 -->
                                    <h6>Step 4</h6>
                                    <section>
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-6">
                                            <h3>Amenities</h3>
@foreach ($amenities as $k=>$v)
<label for="a{{$k}}" class="btn btn-primary">{{$v}}{{Form::checkbox("amenity[]",$k ,false, [ "class" => "badgebox ml-2","id"=>'a'.$k])}}<span class="badge badge-light">&check;</span>
</label>
{{-- <label for="a{{$k}}">
    {{$v}}{{Form::checkbox("amenity[]",$k ,false, [ "class" => "badgebox","id"=>'a'.$k])}}
    </label> --}}
@endforeach
                                                </div>
                                            </div>
                                    </section>
                                    <!-- Step 5 -->
                                    <h6>Step 5</h6>
                                    <section>
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <label for="wfirstName2">Name your place<span class="danger">*</span> </label>
                                                    {!! Form::text('title','',['id'=>'roomtitle','class'=>'form-control required','placeholder'=>'Room Title', 'required']) !!}
                                                    </div>

                                            </div>
                                        </div>
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <label for="wfirstName2">Describe your place to guests<span class="danger">*</span> </label>
                                                    {!! Form::textarea('description','',['id'=>'roomdesc','class'=>'form-control required','placeholder'=>'Room Description', 'required']) !!}
                                                   </div>

                                            </div>
                                        </div>
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-6">
                                            <label for="wfirstName2">Add photos<span class="danger">*</span> </label>
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
</div>
                                        </div>
                                    </section>
                                    <h6>Step 6</h6>
                                    <section>

                                    <div class="row justify-content-md-center">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <label for="wfirstName2">Price Your Space<span class="danger">*</span> </label>
                                                    {!! Form::text('price','',['id'=>'price','class'=>'form-control required','placeholder'=>'0.00', 'required']) !!}
                                                    </div>

                                            </div>
                                        </div>

                                        <div class="row justify-content-md-center">
                                    <div class="col-md-6">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" id="date-start" class="form-control floating-label" placeholder="Start Date">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" id="date-end" class="form-control floating-label" placeholder="End Date">
							</div>
						</div>
					</div>
				</div>
                </div>

                <input type="button" id="addBtn" value="Create" class="btn btn-primary">
                                    </section>
                                    {!! Form::close() !!}
                                    
                            </div>
                            <button id="newBtn" type="button" class="btn btn-info">Add New Room</button>
                        </div>
                    </div>
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
            form_data.append("accomodates_count", $("#accomodates_count").val());
            form_data.append("bedroom_count", $("#bedroom_count").val());
            form_data.append("bed_count", $("#bed_count").val());
            form_data.append("bathroom_count", $("#bathroom_count").val());
            form_data.append("start_date", $("#date-start").val());
            form_data.append("end_date", $("#date-end").val());
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
                        update_form_data.append("accomodates_count", $("#accomodates_count").val());
                        update_form_data.append("bedroom_count", $("#bedroom_count").val());
                        update_form_data.append("bed_count", $("#bed_count").val());
                        update_form_data.append("bathroom_count", $("#bathroom_count").val());
                        update_form_data.append("start_date", $("#date-start").val());
                        update_form_data.append("end_date", $("#date-end").val());
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
<script type="text/javascript">
		$(document).ready(function(){
            $('#date-end').bootstrapMaterialDatePicker
			({
				weekStart: 0, format: 'DD/MM/YYYY', time: false
			});
			$('#date-start').bootstrapMaterialDatePicker
			({
				weekStart: 0, format: 'DD/MM/YYYY', time: false
			}).on('change', function(e, date)
			{
				$('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
			});



			//$.material.init()
		});
		</script>
<script>
        var map, infoWindow;
        function initMap() {
            //alert(5);
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


{{-- category task start --}}
 <script>
  $(document).ready(function () {
      //alert(5);
    jQuery("#category").change(function(){
        //alert(5);
        var url = "{{URL::to('/')}}";
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
      <script>
      $(document).ready(function () {

var form = $(".validation-wizard").show();

$(".validation-wizard").steps({
    headerTag: "h6"
    , bodyTag: "section"
    , transitionEffect: "fade"
    , titleTemplate: '<span class="step">#index#</span> #title#'
    , labels: {
        finish: "Add Property"
    }
    , onStepChanging: function (event, currentIndex, newIndex) {
        return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
    }
    , onFinishing: function (event, currentIndex) {
        return form.validate().settings.ignore = ":disabled", form.valid()
    }
    , onFinished: function (event, currentIndex) {
        //ajax submit start
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
            form_data.append("accomodates_count", $("#accomodates_count").val());
            form_data.append("bedroom_count", $("#bedroom_count").val());
            form_data.append("bed_count", $("#bed_count").val());
            form_data.append("bathroom_count", $("#bathroom_count").val());
            form_data.append("start_date", $("#date-start").val());
            form_data.append("end_date", $("#date-end").val());
            //amenities start
            var amenityIDs = $("#createForm input:checkbox:checked").map(function(){
            return $(this).val();
            }).get();
           // console.log($("#countries").val()); return;
            form_data.append("amenities", amenityIDs);
            //amenities end
            //country
        //alert(url);
           // return;
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
                        swal("Form Submitted!", d.message);
                        //alert(d.message);
                        location.reload();
                        }
                },
                error:function(d){
                    console.log(d);
                }
            });
        //ajax submit end


        
    }
}), $(".validation-wizard").validate({
    ignore: "input[type=hidden]"
    , errorClass: "text-danger"
    , successClass: "text-success"
    , highlight: function (element, errorClass) {
        $(element).removeClass(errorClass)
    }
    , unhighlight: function (element, errorClass) {
        $(element).removeClass(errorClass)
    }
    , errorPlacement: function (error, element) {
        error.insertAfter(element)
    }
    , rules: {
        email: {
            email: !0
        }
    }
});
});//docready end
      </script>

@endsection
