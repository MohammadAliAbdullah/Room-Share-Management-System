<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Category;
use App\Subcategory;
use App\Country;
use App\State;
use App\City;
use App\Amenities;

class WelcomeController extends Controller
{
    public function index(Request $request){

        // if($request->cat){echo $request->cat;}
        // if($request->scat){echo $request->scat;}
        // if($request->c){echo $request->c;}
        //exit;
        $cat = Category::where('status','1')->pluck('name','id');
        $subcat = Subcategory::where('status','1')->pluck('description','id');
        $country = Country::where('status','1')->pluck('name','id');
        $state = State::where('status','1')->pluck('name','id');
        $city = City::where('status','1')->pluck('name','id');
        $amenities = Amenities::where('status','1')->pluck('name','id');
        
        $allRoom = new Room;
        if($request->cat){$allRoom = $allRoom->where('category_id',$request->cat);}
        if($request->scat){$allRoom = $allRoom->where('subcategory_id',$request->scat);}    
        if($request->c){$allRoom = $allRoom->where('country_id',$request->c);}
        if($request->s){$allRoom = $allRoom->where('state_id',$request->s);}
        if($request->city){$allRoom = $allRoom->where('city_id',$request->city);}
        
        $allRoom = $allRoom->with('photos','amenities','writer','category','subcategory','country','state','city')->orderBy('id','desc')->paginate(10);
        //dd($allRoom);
        return view('welcome.index')
        ->with('rooms',$allRoom)
        ->with('categories',$cat)
        ->with('subcategories',$subcat)
        ->with('amenities',$amenities)
        ->with('countries',$country)
        ->with('states',$state)
        ->with('cities',$city);
        
    }
    public function category($id){

        $categories = Category::with('rooms')->orderBy('name','asc')->get();

        $rooms = Room::with('photos','amenities','writer')
        ->where('category_id',$id)
        ->orderBy('id','desc')
        ->paginate(10);
        return view('welcome.index',compact('rooms','categories'));
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
