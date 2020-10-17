@extends('layouts.admin')
@section('content')
            <div class="row">
                    <!-- column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Basic Table</h4>
                                <h6 class="card-subtitle">Add class <code>.table</code></h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Property Title</th>
                                                <th>Owner Name</th>
                                                <th>Booked By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($booking as $book)
                                            <tr>
                                                <td>{{ ($loop->index + 1) }}</td>
                                                <td>{{$book->room->title}}</td>

                                                <td>{{$book->room->writer->name}}</td>
                                                <td>{{$book->user->name}}</td>

                                                <td><?php if($book->status==0){?><span class="label label-danger">Not Approved</span>
                                                     <?php }
                                                else{ ?>
                                                    <span class="label label-success">Approved</span>
                                                    <?php

                                                }

                                                 ?>
                                                 </td>
                                                <td><?php if($book->status==0){?>
                                                    <button type="button" class="btn btn-secondary btn-circle approved" id="" rid="{{$book->id}}"><i class="fa fa-check"></i> </button>  <?php }
                                                else{ ?>
                                                    <button type="button" class="btn btn-warning btn-circle notapproved" rid="{{$book->id}}"><i class="fa fa-times"></i> </button>
                                                    <?php

                                                }

                                                 ?></td>

                                        @endforeach

                                        </tbody>
                                    </table>
                                    {!! $booking->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection
@section('script')
<script>

    $(document).ready(function () {
        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        //
        var url = "{{URL::to('/')}}";
        $(".approved").click(function(){
            $bookid = $(this).attr('rid');
            //console.log($roomid);
            $.ajax({
                type: "post",
                url:url+'/admin/setbookapproval' ,
                data: {
                    id:$bookid,
                    action:"allow"
                },
                dataType: "json",
                success: function (d) {
                    swal(d.message);
                    location.reload();

                }
            });

        });

        $(".notapproved").click(function(){
            $roomid = $(this).attr('rid');
            //console.log($roomid);
            $.ajax({
                type: "post",
                url:url+'/admin/setapproval' ,
                data: {
                    id:$roomid,
                    action:"deny"
                },
                dataType: "json",
                success: function (d) {
                    swal(d.message);
                    location.reload();

                }
            });

        });
    });
</script>

@endsection
