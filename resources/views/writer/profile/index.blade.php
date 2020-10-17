@extends('layouts.ownerblank')
@section('css')
@endsection
@section('content')
<h3>Profile management</h3>


@if ($profile)
<div id="contentContainer">
{{$profile->title}} <hr>
{{$profile->description}}<br>
{{-- <button class="btn btn-primary">Edit Profile</button> --}}
<button id="editBtn" rid="{{$profile->id}}" type="button" class="btn btn-info">Edit Profile</button>
</div>
@else
<button id="insertBtn" class="btn btn-primary">Insert Profile</button>
@endif

@include('partial.ajaxformerror')
@include('partial.message')
<div id="formContainer">
    {!! Form::open(['url' => 'writer/profile/create','id'=>'createForm']) !!}
    {!! Form::hidden('profileid','', ['id' => 'profileid']) !!}
    {!! Form::label('profiletitle', 'Profile Title', ['class' => 'awesome']) !!}
    {!! Form::text('title','',['id'=>'profiletitle','class'=>'form-control','placeholder'=>'Profile Title']) !!}
    {!! Form::label('profiledesc', 'Profile Description', ['class' => 'awesome']) !!}	
    {!! Form::textarea('description','',['id'=>'profiledesc','class'=>'form-control','placeholder'=>'Profile Description']) !!}
    {!! Form::label('nid', 'National ID', ['class' => 'awesome']) !!}
    {!! Form::text('nid','',['id'=>'nid','class'=>'form-control','placeholder'=>'12345...']) !!}
    {!! Form::label('phone', 'Phone', ['class' => 'awesome']) !!}
    {!! Form::text('phone','',['id'=>'phone','class'=>'form-control','placeholder'=>'01726004037']) !!}
    {!! Form::label('school', 'School', ['class' => 'awesome']) !!}
    {!! Form::text('school','',['id'=>'school','class'=>'form-control','placeholder'=>'Ideal School']) !!}
    {!! Form::label('work', 'Work', ['class' => 'awesome']) !!}
    {!! Form::text('work','',['id'=>'work','class'=>'form-control','placeholder'=>'Engneer']) !!}
    {!! Form::label('languages', 'Languages', ['class' => 'awesome']) !!}
    {!! Form::text('languages','',['id'=>'languages','class'=>'form-control','placeholder'=>'Bangla,English']) !!}
    <div class="row">
        <div class="col-9">
            <h3>Change Image</h3>
            <label for="photo" title="Upload Images" class="" title="Change Image">
                <img style="cursor:pointer" src="{{asset('images/image-upload24x24.png')}}" alt="" title="Upload Images">
                </label>
                {!! Form::file('photo',['id'=>'photo','class'=>'d-none','accept'=>'image/gif, image/jpeg, image/png']) !!}
        </div>
        <div class="col-3">
            <h4>Current Image</h4>
            <img src="" id="profileimage" alt="" class="img-fluid">
        </div>
    </div>

    <input type="button" id="addBtn" value="Create" class="btn btn-primary">
    <input type="button" id="formCloseBtn" value="Close" class="btn btn-warning">
    {!! Form::close() !!}



</div>
@endsection {{-- End content section --}}







@section('script')
<script>
    //var storedFiles[] = ;
    $(document).ready(function () {
        $("#formerrors").hide();
        //header for csrf-token is must in laravel 
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        //

        $("#formContainer").hide();
        $("#insertBtn").click(function(){
            clearform();
            $("#insertBtn").hide(100);
            $("#formContainer").show(300);
            
        });
        $("#formCloseBtn").click(function(){
            $("#formContainer").hide(200);
            $("#insertBtn").show(100);
            clearform();
        });


         var url = "{{URL::to('/')}}";
        $("#addBtn").click(function(){
            $('#formerrors').hide();
            $('#formerrors ul').empty();
            //create profile            
            if($(this).val() == 'Create'){
                var form_data = new FormData();               
                //for(var i=0, len=storedFiles.length; i<len; i++) {
                			//form_data.append('photo', storedFiles);
                	//	}
            //form_data.append("photo", storedFiles);
            var photo = document.getElementById('photo').files[0];
            //form_data.append("photo", $("#photo").val());
            form_data.append("photo", photo);
            form_data.append("title", $("#profiletitle").val());            
            form_data.append("description", $("#profiledesc").val()); 
            form_data.append("nid", $("#nid").val());
            form_data.append("phone", $("#phone").val());
            form_data.append("school", $("#school").val());
            form_data.append("work", $("#work").val());
            form_data.append("languages", $("#languages").val());
         
            $.ajax({
                url:url+'/writer/profile',
                method: "POST",
                contentType: false,
                processData: false,
                data:form_data,
                success: function(d){                    
                   // console.log(d); return;
                    if(d.success) {
                        form_data = new FormData();
                        storedFiles=[];
                        alert(d.message);
                        location.reload();
                        }
                    else {
                        $.each(d.errors, function(key, value){
                  			$('#formerrors').show();
                              $('#formerrors ul').append('<li>'+value+'</li>');
                            });
                    }    
                },
                error:function(d){
                    console.log(d);
                }
            });
            }
            //create profile end
             //Update profile start
             if($(this).val() == 'Update'){
                $('#formerrors').hide();
                var form_data = new FormData(); 
            form_data.append("_method", 'PUT');            
            var photo = document.getElementById('photo').files[0];
            //form_data.append("photo", $("#photo").val());
            form_data.append("photo", photo);
            form_data.append("title", $("#profiletitle").val());            
            form_data.append("description", $("#profiledesc").val()); 
            form_data.append("nid", $("#nid").val());
            form_data.append("phone", $("#phone").val());
            form_data.append("school", $("#school").val());
            form_data.append("work", $("#work").val());
            form_data.append("languages", $("#languages").val());
            form_data.append("profileid", $("#profileid").val());


                $.ajax({
                url:url+'/writer/profile/'+$("#profileid").val(),
                method: "POST",
                type: "POST",
                contentType: false,
                processData: false,
                data:form_data,
                success: function(d){
                    if(d.success) {
                        form_data = new FormData();
                        storedFiles=[];
                        alert(d.message);
                        location.reload();
                        }
                    else {
                        $.each(d.errors, function(key, value){
                  			$('#formerrors').show();
                              $('#formerrors ul').append('<li>'+value+'</li>');
                            });
                    }
                },
                error:function(d){
                    console.log(d);
                }
            });  
            }
            //Update profile end

             });


        //Edit profile
        $("#contentContainer").on('click','#editBtn', function(){
            //alert()
            $profileId = $(this).attr('rid');
            //console.log($roomid);
            $info_url = url + '/writer/profile/'+$profileId+'/edit';
            $.get($info_url,{},function(d){
                //console.log(d);
                populateForm(d);
                location.hash = "formContainer";
            });
        });        
        //Edit profile end


        //populate form for edit profile
        function populateForm(data){

            //form_data.append("photo", $("#photo").val());
            $("#profiletitle").val(data.title);            
            $("#profiledesc").val(data.description); 
            $("#nid").val(data.nid);
            $("#phone").val(data.phone);
            $("#school").val(data.school);
            $("#work").val(data.work);
            $("#languages").val(data.languages);
            $("#profileid").val(data.id);
            $("#profileimage").attr('src',url+'/storage/opi/'+data.image);


            //show all images
            // $img_cont = '';
            // $.each($images,function (k,v) {
            //     $i = v.name.split(".");
            //     $img_cont += '<img class="mr-2" src="{{url('/')}}/storage/postimages/'+$i[0]+ '_thumb.'+$i[1]+'">';
            //     //console.log(v.name + " : "+ v.id);                
            // });            
            // $("#imageContainer").html($img_cont);

            $("#addBtn").val('Update');
            $("#formContainer").show(300);
            $("#insertBtn").hide(100);
            $("#contentContainer").hide(100);
        }
        //End populate form for edit profile


        //from clear
        function clearform(){
            $('#createForm')[0].reset();
            $("#addBtn").val('Create');
        }




    });
</script>
@endsection {{-- End sript section --}}
