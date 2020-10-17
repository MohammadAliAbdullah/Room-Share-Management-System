@extends('layouts.ownerblank')
@section('css')
<style>
</style>
@endsection
@section('content')
<h3>Propertywise Reservations</h3>
@forelse ($rooms as $room)
<h3>Property : <a target="_blank" href="{{url('property/'.$room->id)}}">{{$room->title}}</a></h3>
<table class="table table-sm table-condensed table-bordered">
    <tr>
        <th>Booking id</th>
        <th>User</th>
        <th>Checkin<br>Checkout</th>
        <th>rent<br>total rent<br>VAT/TAX<br>Service Fee<br>Amount Paid</th>
        <th class="d-none">Cancel Date</th>
        <th>Refund</th>
        <th>Trx ID</th>
        <th>Booking Date</th>
        <th>Status</th>
        <th>Action</th>
    <tr>
        @forelse ($room->bookings as $booking)
    <tr>
        <td>{{$booking->id}}</td>
        <td><a href="{{'userprofile/'.$booking->user_id}}" title="Visit {{$booking->user->name}} profile">{{$booking->user->name}}</a></td>
        <td>{{$booking->check_in_date}} <br>{{$booking->check_out_date}} </td>
        <td>{{$booking->price_per_day}} <br>{{$booking->price_for_day}} <br>{{$booking->tax_paid}} <br> {{$booking->site_fees}} <br> {{$booking->amount_paid}}</td>
        <td class="d-none">{{$booking->cancel_date}}</td>
        <td>{{$booking->refund_paid}}</td>
        <td>{{$booking->transaction_id}}</td>
        <td>{{$booking->booking_date}}</td>
        <td>{{$booking->status}}</td>
        <td>
            <ul class="list-unstyled">
                <li><a class="text-success" href="#">Confirm and notify</a> </li>
                <li><a class="text-danger" href="#">Discard and notify</a> </li>
                <li><a class="text-warning" href="#">Report</a> </li>
                <li><a class="text-muted" href="#">Change Status</a>
        </td>
        </li>
        </ul>
    </tr>


    @empty
    <tr>
        <th colspan="15">No booking Found for this property</th>
    </tr>
    @endforelse
</table>


@empty
<h3>No room found</h3>
@endforelse

@endsection
@section('script')
<script>
</script>
@endsection