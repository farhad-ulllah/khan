<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\file;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Services\SlugService;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category=Category::all();
        return view('admin.category.index',['category'=>$category]);
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        $category=new Category();
        if($request->hasFile('image'))
        {
        //   $imageName = time().'.'.$request->image->extension(); 
              $file = $request->file('image');
                    $imageName = $file->getClientOriginalName();
           $request->image->storeAs('public/category', $imageName);
           $category->image=$imageName;
        }else{
            $category->image='';
        }
        $category->name=$request->cat_name;
        $category->slug=Str::slug($request->cat_slug);
        $category->description=$request->cat_desc;
        $category->status=$request->status==true ? '1':'0';
        $category->popular=$request->popular==true ? '1':'0';
        $category->meta_title=$request->cat_met_title;
        $category->meta_keywords=$request->cat_met_keyword;
        $category->meta_descrip=$request->cat_met_desc;
         $category->alt_image=$request->alt_image;
        $added=$category->save();
    if($added){
        alert::success('Category Added Successfully');
        return redirect()->back();
    }else{
        alert::error('Category Not Added');
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
        $category=Category::find($id);
       return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $category=Category::find($id);
        if($request->hasFile('image')) {
            $file_name = time().'.'.$request->image->extension(); 
            $path = $request->file('image')->storeAs('public/category',$file_name);
            $category->image=$file_name;
            $Image = str_replace('/storage', '', $request->old_image);
            #Using storage
            if(Storage::exists('public/category/' . $Image)){
               $delete= Storage::delete('/public/category/' . $Image);
              
            }
        } else{
            $category->image='';
        }
        $category->name=$request->cat_name;
        $category->slug=Str::slug($request->cat_slug);
        $category->description=$request->cat_desc;
        $category->status=$request->status==true ? '1':'0';
        $category->popular=$request->popular==true ? '1':'0';
        $category->meta_title=$request->cat_met_title;
        $category->meta_keywords=$request->cat_met_keyword;
        $category->meta_descrip=$request->cat_met_desc;
           $category->alt_image=$request->alt_image;
        $category->update();
        alert::success('Category Updated Successfully');
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
        $category=Category::find($id);
     
        if($category->image)
        {
            if(Storage::exists('public/category/' . $category->image)){
            $delete= Storage::delete('/public/category/' . $category->image);   
             }
        }
        $category->delete();
        alert::success('Category Deleted Successfully');
        return redirect()->back();
    }
    public function get_cat_slug()
    {
       $slug=SlugService::createSlug(Category::class,'slug',request('cat_name'));
       return response()->json(['cat_slug'=>$slug]);
    }

}
