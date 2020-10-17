<?php

namespace App\Http\Controllers\Writer;

use App\Amenities;
use App\Category;
use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use App\Photo;
use App\Room;
use App\State;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use App\Notification;
use App\Admin;
use App\Custom\Push;
use function GuzzleHttp\json_encode;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // if (Cache::has('roomindex')) {
        //     $rooms = Cache::get('roomindex');
        // }
        // else{
        //     $rooms = Room::with('writer')->where('writer_id',Auth::id())->orderBy('id','desc')->paginate(5);
        //     Cache::add('roomindex', $rooms, 20);
        // }
        $country = Country::pluck('name', 'id');
        $category = Category::pluck('name', 'id');
        $amenities = Amenities::pluck('name', 'id');
        //dd($amenities);
        $rooms = Room::with('photos', 'writer', 'amenities')->where('writer_id', Auth::id())->orderBy('id', 'desc')->paginate(5);
        //dd($rooms);
        return view('writer.room.index')
        //return view('writer.room.indexmain')
        ->with('rooms', $rooms)
            ->with('amenities', $amenities)
            ->with('country', $country)
            ->with('category', $category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('writer.room.index');
        //return view('writer.room.indexmain');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$amenities = $request->amenities;
        $writer = Auth::user();
        $room = new Room();
        $room->title = $request->title;
        $room->description = $request->description;
        $room->price = $request->price;
        $room->country_id = $request->country;
        $room->state_id = $request->state;
        $room->city_id = $request->city;
        $room->category_id = $request->category;
        //$room->category_id = 1;
        $room->subcategory_id = $request->subcategory;
        //$room->subcategory_id = 2;
        $room->latitude = $request->latitude ? $request->latitude : '0';
        $room->longitude = $request->longitude ? $request->longitude : '0';
        $room->accomodates_count = $request->accomodates_count;
        $room->bedroom_count = $request->bedroom_count;
        $room->bed_count = $request->bed_count;
        $room->bathroom_count = $request->bathroom_count;
        $room->start_date = $request->start_date;
        $room->end_date = $request->end_date;
        $room->availability_type = 0;
        $room->minimum_stay = 0;

        $writer->rooms()->save($room);
        // dd($room);return;
        $amenities = explode(",", $request->amenities);
        if (count($amenities)) {
            $room->amenities()->sync($amenities);
        }
        if ($room->id) {
            //image upload start
            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $image) {
                    $rand = mt_rand(100000, 999999);
                    $name = time() . "_" . Auth::id() . "_" . $rand . "." . $image->getClientOriginalExtension();
                    $name_thumb = time() . "_" . Auth::id() . "_" . $rand . "_thumb." . $image->getClientOriginalExtension();
                    //return response()->json(['a'=>storage_path() . '/app/public/postimages/'. $name]);
                    //move image to postimages folder
                    $image->move(storage_path() . '/app/public/postimages/', $name);
                    $resizedImage = Image::make(storage_path() . '/app/public/postimages/' . $name)->resize(1280, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $resizedImage_thumb = Image::make(storage_path() . '/app/public/postimages/' . $name)->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    // save file as jpg with medium quality
                    $resizedImage->save(storage_path() . '/app/public/postimages/' . $name, 60);
                    $resizedImage_thumb->save(storage_path() . '/app/public/postimages/' . $name_thumb, 60);
                    $data[] = $name;
                    //insert into picture table
                    $pic = new Photo();
                    $pic->name = $name;
                    $room->photos()->save($pic);
                }

            }
            //image upload end
            //notify admin that a new Listing has created
            $n = new Notification();
            $n->message = "New Listing created with id:".$room->id." By " . $writer->name;
            $n->type = "listing";
            $n->note_id = $writer->id;
            $admin = Admin::find(1);
            $admin->notifications()->save($n);
            //pusher
            $data = [];
            $data['message'] = $n->message;
            $data['type'] = "listing";
            $data['from'] = $writer->id;
            $data['time'] = $n->created_at;

            $pusher = Push::newPush();
            $pusher->trigger('notification-channel', 'admin-1', array('message' => json_encode($data)));
            //notify admin that a new Listing has created END

            return response()->json(['success' => true, 'message' => 'Room Created!!'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Error!!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = [
            'writer_id' => Auth::id(),
            'id' => $id,
        ];
        $info = Room::with('amenities', 'photos')->where($where)->get()->first();
        return response()->json($info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //return response()->json(['success'=>true,'message'=>$request->title]);
        $where = [
            'writer_id' => Auth::id(),
            'id' => $room->id,
        ];
        $roomtoupdate = Room::where($where)->get()->first();
        $roomtoupdate->title = $request->title;
        $roomtoupdate->description = $request->description;
        $roomtoupdate->price = $request->price;
        if ($roomtoupdate->save()) {
            //amenities update
            $amenities = explode(",", $request->amenities);
            if (count($amenities)) {
                $roomtoupdate->amenities()->sync($amenities);
            }
//image upload start
            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $image) {
                    $rand = mt_rand(100000, 999999);
                    $name = time() . "_" . Auth::id() . "_" . $rand . "." . $image->getClientOriginalExtension();
                    $name_thumb = time() . "_" . Auth::id() . "_" . $rand . "_thumb." . $image->getClientOriginalExtension();
                    //return response()->json(['a'=>storage_path() . '/app/public/postimages/'. $name]);
                    //move image to postimages folder
                    $image->move(storage_path() . '/app/public/postimages/', $name);
                    $resizedImage = Image::make(storage_path() . '/app/public/postimages/' . $name)->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $resizedImage_thumb = Image::make(storage_path() . '/app/public/postimages/' . $name)->resize(120, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    // save file as jpg with medium quality
                    $resizedImage->save(storage_path() . '/app/public/postimages/' . $name, 60);
                    $resizedImage_thumb->save(storage_path() . '/app/public/postimages/' . $name_thumb, 70);
                    $data[] = $name;
                    //insert into picture table
                    $pic = new Photo();
                    $pic->name = $name;
                    $roomtoupdate->photos()->save($pic);
                }

            }
//image upload end

            return response()->json(['success' => true, 'message' => 'Listing Updated']);
        } else {
            return response()->json(['success' => false, 'message' => 'Update Failed']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        if (Room::destroy($room->id)) {
            return response()->json(['success' => true, 'message' => 'Listing Deleted']);
        } else {
            return response()->json(['success' => false, 'message' => 'Update Failed']);
        }
    }

    public function search(Request $request)
    {
        $users = DB::table('rooms')
            ->where('writer_id', Auth::id())
            ->whereRaw('(`title` like "%' . $request->searchText . '%" or `description` like "%' . $request->searchText . '%")')
            ->get();
        return response()->json($users);
    }

    public function selectstate($id)
    {
        $state = State::where('country_id', $id)->get()->toArray();
        return response()->json($state);

    }
    public function selectcity($id)
    {
        $city = City::where('state_id', $id)->get()->toArray();
        return response()->json($city);

    }
    public function selectsubcat($id)
    {
        $subcat = Subcategory::where('category_id', $id)->get()->toArray();
        return response()->json($subcat);

    }
}
