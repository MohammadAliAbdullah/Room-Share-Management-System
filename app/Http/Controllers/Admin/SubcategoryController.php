<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategory = Subcategory::with('category')->latest()->paginate(config('room.pagesize'));
        return view('admin.subcategory.index')->with('subcategories',$subcategory);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('admin.subcategory.create')->with('allcat',$categories);
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
            'category_id' => 'required',
            'name' => 'required|min:3',            
        ]);        
        $newsubcat = new Subcategory();
        $newsubcat->category_id = $request->category_id;
        $newsubcat->name = $request->name;
        $newsubcat->status = (@$request->status=="on")?1:0;
        if($newsubcat->save()){
            return redirect('admin/subcategory')->with('message','Subcategory Created Successfully');
        }
        else{
            return redirect('admin/subcategory')->with('message','Error!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        $allcat = Category::pluck('name', 'id');
        $subcategory = Subcategory::find($subcategory->id);
        return view('admin.subcategory.edit',compact('subcategory','allcat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|min:3',
            
        ]); 
        $s_c = Subcategory::find($subcategory->id);
        $s_c->category_id = $request->category_id;
        $s_c->name = $request->name;
        $s_c->status = (@$request->status=="on")?1:0;
        if($s_c->save())
        return redirect()->route('subcategory.index')
            ->with('success','Subcategory updated successfully');
            else
            return redirect()->route('subcategory.index')
            ->with('success','Error!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        if(Subcategory::destroy($subcategory->id)){
            return redirect('admin/subcategory')->with('message','Subcategory Deleted');
        }
        else{
            return redirect('admin/subcategory')->with('message','Error!!');
        }
    }
}
