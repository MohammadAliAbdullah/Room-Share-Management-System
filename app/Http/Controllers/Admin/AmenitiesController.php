<?php

namespace App\Http\Controllers\Admin;

use App\Amenities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ameniti = Amenities::latest()->paginate(config('room.pagesize'));
        return view('admin.amenities.amenities')->with('amenities',$ameniti);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.amenities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        //dd($request);
        $request->validate([
            'name' => 'required|max:40',
            'icon_image' => 'required|image',
            'status' => 'required'
        ]);   
        
        $imageName = time() ."_".rand(1000,5000). '.' .$request->file('icon_image')->getClientOriginalExtension();
       
       $request->file('icon_image')->move(base_path().'/public/images/amenities/', $imageName
    );
    


        $list = new Amenities();
        $list->name = $request->name;
        $list->icon_image =$imageName;
        $list->status = $request->status;
        $list->save();
        if($list->save()){
            return redirect('admin/amenities')->with('message','Category Created Successfully');
        }
        else{
            return redirect('admin/amenities')->with('message','Error!!');
        }
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Amenities  $amenities
     * @return \Illuminate\Http\Response
     */
    public function show(Amenities $amenities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Amenities  $amenities
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $amenities = Amenities::find($id);
        //dd($amenities->id);
        return view('admin.amenities.edit',compact('amenities'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Amenities  $amenities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Amenities $amenities)
    {
        $request->validate([
            'name' => 'required|max:40',
            'icon_image' => 'required|image',
            'status' => 'required'
        ]); 
        if(Amenities::find($ameniti->id)->update($request->all()))
        return redirect()->route('ameniti.index')
            ->with('success','Amenity updated successfully');
            else
            return redirect()->route('ameniti.index')
            ->with('success','Error!!');    
    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Amenities  $amenities
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Amenities::destroy($id)){
            return redirect('admin/amenities')->with('message','Amenities  Deleted');
        }
        else{
            return redirect('admin/amenities')->with('message','Error!!');
        }
    }
    
}
