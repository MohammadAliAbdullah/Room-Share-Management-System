<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::latest()->paginate(config('room.pagesize'));
        return view('admin.category.index')->with('categories',$category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'description' => 'required|min:5',            
        ]);        
        $newcat = new Category();
        $newcat->name = $request->name;
        $newcat->description = $request->description;
        $newcat->status = (@$request->status=="on")?1:0;
        if($newcat->save()){
            return redirect('admin/category')->with('message','Category Created Successfully');
        }
        else{
            return redirect('admin/category')->with('message','Error!!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $category = Category::find($category->id);
        return view('admin.category.edit',compact('category'));       
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:40',
            'description' => 'required|min:5',            
        ]); 
        $c = Category::find($category->id);
        $c->name = $request->name;
        $c->description = $request->description;
        $c->status = (@$request->status=="on")?1:0;
        if($c->save())
        return redirect()->route('category.index')
            ->with('success','Category updated successfully');
            else
            return redirect()->route('category.index')
            ->with('success','Error!!');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(Category::destroy($category->id)){
            return redirect('admin/category')->with('message','Category Deleted');
        }
        else{
            return redirect('admin/category')->with('message','Error!!');
        }
    }
}
