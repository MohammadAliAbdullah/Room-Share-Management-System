<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Booking;
use Carbon\Carbon;
use App\MyClass\CommonFx;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function bookroom($roomid){
        //$user = Auth::id();
        $roominfo = Room::with('writer.profile')->find($roomid);
        //dd($roominfo);
        return view('user.booking.form')
        ->with('room',$roominfo);
    }
    public function step1(Request $request){
        //$sdate = $request->startdate;
        //$edate = $request->enddate;
        //$guests = $request->guests;
        //$rid = $request->roomid;

        $room = Room::find($request->roomid);
//        $datef = new Carbon($request->startdate, 'Asia/Dhaka');
//        $datet = new Carbon($request->enddate, 'Asia/Dhaka');
//        CommonFx is our custom class in App\MyClass
        $totalDays = CommonFx::totalDays($request->startdate,$request->enddate);
        //return response()->json(['success'=>true,'message'=>$totalDays]);
        $booking = new Booking();
        $booking->user_id = Auth::id();
        $booking->currency_id = 1;
        $booking->check_in_date = $request->startdate;
        $booking->check_out_date = $request->enddate;
        $booking->price_per_day = $room->price;
        $booking->price_for_stay = (float) ($totalDays * $room->price);
        $booking->tax_paid = 0;
        $booking->site_fees = 0;
        $booking->amount_paid = 0;
        $booking->refund_paid = 0;
        $booking->effective_amount = 0;
        $booking->booking_date = date('Y-m-d H:i:s');
        $booking->status = 0;
        if ($room->bookings()->save($booking)) {
            //###########notification#################
            //notify admin that a new Listing has created
            $n = new Notification();
            $n->message = "New booking requested with booking id:".$booking->id." for Listing ".$room->id." By " . Auth::user()->name;
            $n->type = "booking";
            $n->note_id = Auth::id();
            $n2 = clone $n;
            $owner = Writer::find($room->writer_id);
            $owner->notifications()->save($n);
            $admin = Admin::find(1);
            $admin->notifications()->save($n2);
            //pusher
            $data = [];
            $data['message'] = $n->message;
            $data['type'] = "booking";
            $data['from'] = Auth::id();
            $data['time'] = $n->created_at;

            $pusher = Push::newPush();
            $batch = [];
            $batch[] = array('channel' => 'notification-channel', 'name' => 'admin-1', 'data' => array('message' => json_encode($data)));
            $batch[] = array('channel' => 'notification-channel', 'name' => 'owner-'.$room->writer_id, 'data' => array('message' => json_encode($data)));
            $pusher->triggerBatch($batch);
            // $pusher->trigger('notification-channel', 'owner-'.$room->writer_id, array('message' => json_encode($data)));
            // $pusher->trigger('notification-channel', 'owner-'.$room->writer_id, array('message' => json_encode($data)));
            //###########notification END#################
            return response()->json(['success'=>true,'message'=>'Step1 Complete']);
        }
        else{
            return response()->json(['success'=>false,'message'=>'Error']);
        }
    }
}
