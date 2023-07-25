<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\file;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Services\SlugService;
class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category=BlogCategory::all();
        return view('admin.blog_category.index',['category'=>$category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog_category.add_category');
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
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cat_name'=>'required',
        ]);
        $category=new BlogCategory();
     
        $category->name=$request->cat_name;
        $category->slug=Str::slug($request->cat_slug);
        $category->description=$request->cat_desc;
        $category->meta_title=$request->cat_met_title;
        $category->meta_keywords=$request->cat_met_keyword;
        $category->meta_description=$request->meta_description;
        $added=$category->save();
    if($added){
        alert::success('BlogCategory Added Successfully');
        return redirect()->back();
    }else{
        alert::error('BlogCategory Not Added');
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
        $category=BlogCategory::find($id);
        return view('admin.blog_category.edit',compact('category'));
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
        $category=BlogCategory::find($id);
        $category->name=$request->cat_name;
        $category->slug=Str::slug($request->cat_slug);
        $category->description=$request->cat_desc;
        $category->meta_title=$request->cat_met_title;
        $category->meta_keywords=$request->cat_met_keyword;
         $category->meta_description=$request->meta_description;
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
        $category=BlogCategory::find($id);
     
        $category->delete();
        alert::success('Category Deleted Successfully');
        return redirect()->back();
    }
    public function checkBlogcatslug()
    {
       $slug=SlugService::createSlug(BlogCategory::class,'slug',request('cat_name'));
       return response()->json(['cat_slug'=>$slug]);
    }
}
