<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\file;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders=Slider::all();
        return view('admin.sliders.index',compact('sliders'));
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
            'title' => 'required',
             'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $data=[
                'title'=>$request->title,
                'created_at'=>date('Y-m-d H:m:s')
            ];
            if($request->hasFile('image'))
            {
            //   $imageName = time().'.'.$request->image->extension();
             $file = $request->file('image');
                    $imageName = $file->getClientOriginalName();
              $request->image->storeAs('public/slider', $imageName);
              $data['image'] = $imageName;
            
            }else{
                $data['image']=''  ;
            }
            $item = Slider::insert($data);
            if($item){
            alert::success('Post Added Successfully');
            return redirect()->back();
         }else{
            alert::success('Post Not Added');
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
        //
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
        $slider=Slider::find($request->id);
        if($request->hasFile('image')) {
            $file = $request->file('image');
                    $file_name = $file->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/slider',$file_name);
            $slider->image=$file_name;
            $Image = str_replace('/storage', '', $request->old_image);
            #Using storage
            if(Storage::exists('public/slider/' . $Image)){
               $delete= Storage::delete('/public/slider/' . $Image);
            }
        } 
        $slider->title=$request->title;
        $slider->updated_at=date('Y-m-d H:m:s');
        $slider->update();
        alert::success('Slider Updated Successfully');
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
        $slider=Slider::find($id);
        if($slider->image)
        {
            if(Storage::exists('public/slider/' . $slider->image)){
            $delete= Storage::delete('/public/slider/' . $slider->image);   
             }
        }
        $slider->delete();
        alert::success('slider Deleted Successfully');
        return redirect()->back();
    }
}
