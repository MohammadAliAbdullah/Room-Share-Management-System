<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Writer;
use App\Room;
use App\Booking;
use App\Admin;

class DashboardController extends Controller
{
    public function index(){
        $admin = Admin::with(['notifications'=>function($query) {
            return $query->latest()->limit(15);
        }])->find(1);
        
        $dashboardData = [];
        $dashboardData['totalUsers'] = User::count();
        $dashboardData['totalOwners'] = Writer::count();
        $dashboardData['totalListings'] = Room::count();
        $dashboardData['totalBookings'] = Booking::count();
        $dashboardData['admin'] = $admin;
        //dd($dashboardData);
        //$totalListingImages = Photos::all();
        return view('admin.dashboard',compact('dashboardData'));
    }
    public function user(){
        return view('admin.user.index');
    }
}
