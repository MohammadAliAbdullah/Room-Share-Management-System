<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\State;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city = City::latest()->paginate(10);
        return view('admin.city.index')->with('cities',$city);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $state = State::orderBy('country_id')->pluck('name', 'id');
        return view('admin.city.create')->with('state',$state);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:40',
            'state_id' => 'required',
        ]);        
        $newCity = new City();
        $newCity->name = $request->name;
        $newCity->state_id = $request->state_id;
        $newCity->status = (@$request->status=="on")?1:0;
        if($newCity->save()){
            return redirect('admin/city')->with('message','City Created Successfully');
        }
        else{
            return redirect('admin/city')->with('message','Error!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $city = City::find($city->id);
        $state = State::pluck('name', 'id');
        //dd($states); exit;
        //dd($city); exit;
        return view('admin.city.edit',compact('city','state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|max:40',
            'state_id' => 'required',
        ]); 
        $c = City::find($city->id);
        $c->name = $request->name;
        $c->state_id = $request->state_id;
        $c->status = (@$request->status=="on")?1:0;

        if($c->save()) 
        // if(City::find($city->id)->update($request->all()))
        return redirect()->route('city.index')
            ->with('success','City updated successfully');
            else
            return redirect()->route('city.index')
            ->with('success','Error!!');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        if(City::destroy($city->id)){
            return redirect('admin/city')->with('message','City Deleted');
        }
        else{
            return redirect('admin/city')->with('message','Error!!');
        }
    }
}
