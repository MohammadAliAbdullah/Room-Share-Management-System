<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(){
        $admin = Admin::with("notifications")->find(Auth::id());
        dd($admin);
        return view("admin.notification.index")->with('adminnotification',$admin);
    }
}
