<?php

namespace App\Http\Controllers\Writer;

use App\Writer_profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$p = Writer_profile::where('writer_id',Auth::id())->get()->first()->toArray();
        $p = Writer_profile::where('writer_id',Auth::id())->get()->first();
        //dd($p);
        return view('writer.profile.index')->with('profile',$p);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'nid' => 'required',
            'phone' => 'required'            
        ]);
        if ($validator->fails())
        {
            return response()->json([
                'success'=>false,
                'errors'=>$validator->errors()->all()
                ]);
        }
            
        //image upload start
            if ($request->hasfile('photo')) {
                   $image = $request->file('photo');
                    $rand = mt_rand(100000, 999999);
                    $name = time() . "_" . Auth::id() . "_" . $rand . "." . $image->getClientOriginalExtension();
                    $name_thumb = time() . "_" . Auth::id() . "_" . $rand . "_thumb." . $image->getClientOriginalExtension();
                    //return response()->json(['a'=>storage_path() . '/app/public/postimages/'. $name]);
                    //move image to postimages folder
                    $image->move(storage_path() . '/app/public/opi/', $name);
                    $resizedImage = Image::make(storage_path() . '/app/public/opi/' . $name)->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $resizedImage_thumb = Image::make(storage_path() . '/app/public/opi/' . $name)->resize(120, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    // save file as jpg with medium quality
                    $resizedImage->save(storage_path() . '/app/public/opi/' . $name, 60);
                    $resizedImage_thumb->save(storage_path() . '/app/public/opi/' . $name_thumb, 70);
                    //$data[] = $name;
            }
            else{
                $name = 'not-found.jpg';
            }

            //image upload end
            $writer = Auth::user();
            $profile = new Writer_profile();
            $profile->title = $request->title;
            $profile->description = $request->description;
            $profile->nid = $request->nid;
            $profile->phone = $request->phone;
            $profile->school = $request->school;
            $profile->work = $request->work;
            $profile->languages = $request->languages;
            $profile->status = 1;
            $profile->image = $name;
            //$profile->image = "test-image";
            $writer->profile()->save($profile);
            return response()->json([
                'success'=>true,
                'message'=>'Profile Created!!'
            ], 200);           

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = [
            'writer_id'=>Auth::id(),
            'id'=>$id
        ];
        $info = Writer_profile::where($where)->get()->first();
        return response()->json($info);
        //dd($info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'nid' => 'required',
            'phone' => 'required'            
        ]);
        if ($validator->fails())
        {
            return response()->json([
                'success'=>false,
                'errors'=>$validator->errors()->all()
                ]);
        }
        
        //return response()->json(['success'=>true,'message'=>$id], 200);  
        //exit;
        //image upload start
          if ($request->hasfile('photo')) {
            $image = $request->file('photo');
             $rand = mt_rand(100000, 999999);
             $name = time() . "_" . Auth::id() . "_" . $rand . "." . $image->getClientOriginalExtension();
             $name_thumb = time() . "_" . Auth::id() . "_" . $rand . "_thumb." . $image->getClientOriginalExtension();
             //return response()->json(['a'=>storage_path() . '/app/public/postimages/'. $name]);
             //move image to postimages folder
             $image->move(storage_path() . '/app/public/opi/', $name);
             $resizedImage = Image::make(storage_path() . '/app/public/opi/' . $name)->resize(800, null, function ($constraint) {
                 $constraint->aspectRatio();
             });
             $resizedImage_thumb = Image::make(storage_path() . '/app/public/opi/' . $name)->resize(120, null, function ($constraint) {
                 $constraint->aspectRatio();
             });
             // save file as jpg with medium quality
             $resizedImage->save(storage_path() . '/app/public/opi/' . $name, 60);
             $resizedImage_thumb->save(storage_path() . '/app/public/opi/' . $name_thumb, 70);
             $data[] = $name;
     }
     else{
        $name = 'not-found.jpg';
    }

     //image upload end
     $id = $request->profileid;
     $where = [
        'writer_id'=>Auth::id(),
        'id'=>$id
    ];
    //dd($where);exit;
    $profile = Writer_profile::where($where)->get()->first();
    //  $profile = new Writer_profile();
     $profile->title = $request->title;
     $profile->description = $request->description;
     $profile->nid = $request->nid;
     $profile->phone = $request->phone;
     $profile->school = $request->school;
     $profile->work = $request->work;
     $profile->languages = $request->languages;
     $profile->status = 1;
     $profile->image = $name;
     //$profile->image = "test-image";
     $profile->save();
     return response()->json(['success'=>true,'message'=>'Profile Updated!!'], 200);           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
