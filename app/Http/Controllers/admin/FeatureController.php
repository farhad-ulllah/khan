<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;
use auth;
use Illuminate\Support\Facades\file;
use RealRashid\SweetAlert\Facades\Alert;
use Storage;
class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->permission('view feature')) {
            $feature= Feature::all();
            return view('admin.feature.index',compact('feature'));
            }else{
                return view('permission_denied');
            }
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
        $request->validate([
            'feature_name' => 'required',
            'feature_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $data=[
            'feature_name' => $request->feature_name,
            'created_at'=>date('Y-m-d H:m:s')
        ];
        if($request->hasFile('feature_icon'))
        {
           $imageName = time().'.'.$request->feature_icon->extension(); 
          $request->feature_icon->storeAs('public/feature_icons', $imageName);
          $data['feature_icon'] = $imageName;
        
        }else{
            $data['feature_icon']=''  ;
        }
        $Added = Feature::insert($data);
    if($Added){
        alert::success('Feature Added Successfully');
        return redirect()->back();
    }else{
        alert::success('Feature Not Added');
        return redirect()->back();
    }
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
        $Feature=Feature::all();
        $data=Feature::find($id);
        return view('admin.feature.edit',compact('Feature','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $feature=Feature::find($request->id);
        if($request->hasFile('feature_icon')) {
            $file_name = time().'.'.$request->feature_icon->extension(); 
            $path = $request->file('feature_icon')->storeAs('public/feature_icons',$file_name);
            $feature->feature_icon=$file_name;
            $Image = str_replace('/storage', '', $request->old_image);
            #Using storage
            if(Storage::exists('public/feature_icons/' . $Image)){
               $delete= Storage::delete('/public/feature_icons/' . $Image);
            }
        } 
        $feature->feature_name=$request->feature_name;
        $feature->updated_at=date('Y-m-d H:m:s');
        $feature->update();
        alert::success('feature Updated Successfully');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Feature=Feature::find($id);
        if($Feature->feature_icon)
        {
            if(Storage::exists('public/feature_icons/' . $Feature->feature_icon)){
            $delete= Storage::delete('/public/feature_icons/' . $Feature->feature_icon);   
             }
        }
        $Feature->delete();
        alert::success('Feature Deleted Successfully');
        return redirect()->back();
    }
}
