<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $country= Country::latest()->paginate(2);
        return view('admin.country.index')->with('countries',$country);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.country.create');
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
        ]);        
        $newcon = new Country();
        $newcon->name = $request->name;
        $newcon->code = $request->code;
        $newcon->status = $request->status;
        if($newcon->save()){
            return redirect('admin/country')->with('message','Country Created Successfully');
        }
        else{
            return redirect('admin/country')->with('message','Error!!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        $country = Country::find($country->id);
        return view('admin.country.edit',compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|max:40',
            'code' => 'required',
            'status' => 'required',
    
        ]); 
        if(Country::find($country->id)->update($request->all()))
        return redirect()->route('country.index')
            ->with('success','Country updated successfully');
            else
            return redirect()->route('country.index')
            ->with('success','Error!!');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        if(Country::destroy($country->id)){
            return redirect('admin/country')->with('message','Country Deleted');
        }
        else{
            return redirect('admin/country')->with('message','Error!!');
        }
    }
}
