<?php

namespace App\Http\Controllers\Admin;

use App\State;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $state = State::latest()->paginate(10);
        return view('admin.state.index')->with('states',$state);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = Country::pluck('name', 'id');
        return view('admin.state.create')->with('country',$country);
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
            'code' => 'required',
            'country_id' => 'required',
        ]);        
        $newState = new State();
        $newState->name = $request->name;
        $newState->country_id = $request->country_id;
        $newState->code = $request->code;
        $newState->status =(@$request->status=="on")?1:0;
        if($newState->save()){
            return redirect('admin/state')->with('message','State Created Successfully');
        }
        else{
            return redirect('admin/state')->with('message','Error!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $state = State::find($state->id);
        $country = Country::pluck('name', 'id');
        //dd($states); exit;
        //dd($city); exit;
        return view('admin.state.edit',compact('state','country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $request->validate([
            'name' => 'required|max:40',
            'code' => 'required',
            'country_id' => 'required',
        ]); 
        $s = State::find($state->id);
        $s->name = $request->name;
        $s->code = $request->code;
        $s->country_id = $request->country_id;
        $s->status = (@$request->status=="on")?1:0;

        if($s->save()) 
        // if(State::find($state->id)->update($request->all()))
        return redirect()->route('state.index')
            ->with('success','State updated successfully');
            else
            return redirect()->route('state.index')
            ->with('success','Error!!');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        if(State::destroy($state->id)){
            return redirect('admin/state')->with('message','State Deleted');
        }
        else{
            return redirect('admin/state')->with('message','Error!!');
        }
    }
}
