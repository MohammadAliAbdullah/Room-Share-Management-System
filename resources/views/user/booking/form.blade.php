@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h3>Owner Info</h3>
            <hr>
            Name: {{$room->writer->name}} <br>
            Email: {{$room->writer->email}} <br>
            @if(@$room->writer->profile)
            <h3>{{$room->writer->profile->title}} </h3>
            <p>{{$room->writer->profile->description}}</p>
        <img src="{{asset('storage/opi/'.$room->writer->profile->image)}}" class="img-fluid" alt="">
            @endif

        </div>
        <div class="col-6">
                <h3>Room Booking Form</h3>
                <hr>
                {!! Form::open(['url' => 'user/booking/create','id'=>'createForm']) !!}
                {!! Form::hidden('roomid',$room->id, ['id' => 'roomid']) !!}
                <div class="row form-group">
            
                {!! Form::label('datefrom', 'Date From:', ['class' => 'awesome col-md-2']) !!}
                <input type="date" class="form-control col-md-4" name="datefrom" id="datefrom" required>
                {!! Form::label('dateto', 'Date To:', ['class' => 'awesome col-md-2']) !!}
                <input type="date" class="form-control col-md-4" name="dateto" id="dateto" required>
                </div>
                {!! Form::label('guests', 'Number Of Guests:', ['class' => 'awesome']) !!}
                <input type="number" class="form-control" name="guests" id="guests" required>
            <h3>Per Night Stay: $<span id="pna" title="per night amount">{{$room->price}}</span></h3>
            <h3>Total Amount: <span id="tna" title="total night amount"></span></h3>
                <hr>
                <input type="button" value="Proceed" id="step1" class="btn btn-primary" name="step1">
                {!! Form::close() !!}
        </div>
    </div>
    
</div>    

@endsection
@section('script')
<script>
$(document).ready(function () {
    $("#dateto").change(function (){
        //console.log($("#datefrom").val()+":"+$("#dateto").val())
        var diff =  Math.floor(( Date.parse($("#dateto").val()) - Date.parse($("#datefrom").val()) ) / 86400000);
        //alert(diff);
        $tna = diff * parseFloat($("#pna").text());
        $("#tna").text("$" + $tna.toFixed(2));
    });
$('#step1').click(function (e) { 
    e.preventDefault();
    $startdate = $("#datefrom").val();
    $enddate = $("#dateto").val();
    $guests = $("#guests").val();
    $roomid = $("#roomid").val();
    $.ajax({
        url: url+'/user/booking',
        method: "POST",
        data:{
            startdate: $("#datefrom").val(),
            enddate: $("#dateto").val(),
            guests: $("#guests").val(),
            roomid: $("#roomid").val()
        },
        success: function(d){
                    console.log(d); 
                    if(d.success) {
                        //form_data = new FormData();
                        //storedFiles=[];
                        alert(d.message);
                        location.reload();
                        }
                },
                error:function(d){
                    console.log(d);
                }
            });//ajax end

    
});
});
</script>
    
@endsection