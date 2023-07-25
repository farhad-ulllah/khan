<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\file;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Services\SlugService;
class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->permission('view blogs')) {
        $blogs=Blog::all();
        return view('admin.blogs.index',compact('blogs'));
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
        if(auth()->user()->permission('add blogs')) {
        $category=BlogCategory::all();
        return view('admin.blogs.create',compact('category'));
           }else{
                return view('permission_denied');
              }
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
        'cat_id'=>'required',
         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
          if($request->title=''){
               alert::success('Please Add Category');
            return redirect()->back();
          }else{
    
        $data=[
            'title'=>$request->title,
            'slug'=>$request->blog_slug,
            'cat_id'=>$request->cat_id,
            'description'=>$request->description,
            'meta_title'=>$request->meta_title,
             'alt_image'=>$request->alt_image,
            'meta_keywords'=>$request->meta_keywords,
             'meta_description'=>$request->meta_description,
             'video'=>$request->video,
            'status'=>1,
            'created_at'=>date('Y-m-d H:i:s'),
        ];
            if($request->hasFile('image')) {
        {
            $file = $request->file('image');
             $imageName = $file->getClientOriginalName();
        //   $imageName =$request->image->extension(); 
          $request->file('image')->storeAs('public/blogs', $imageName);
          $data['image'] = $imageName;
        }
         
        //  if($request->hasFile('video'))
        // {
        //   $videoName = time().'.'.$request->video->extension(); 
        //   $request->video->storeAs('public/blogs', $videoName);
        //   $data['video'] = $videoName;
        
        // }else{
        //     $data['video']=''  ;
        // }
              $item = Blog::insert($data);
            if($item){
            alert::success('Post Added Successfully');
            return redirect()->back();
         }else{
            alert::success('Post Not Added');
            return redirect()->back();
         }
          }
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
        if(auth()->user()->permission('edit blogs')) {
        $category=BlogCategory::all();
        $blog=Blog::find($id);
        return view('admin.blogs.edit',compact('blog','category'));
    }else{
        return view('permission_denied');
      }
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
      
        $blogs=Blog::find($id);
        if($request->hasFile('image')) {
              $file = $request->file('image');
             $file_name = $file->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/blogs',$file_name);
            $blogs->image=$file_name;
            $Image = str_replace('/storage', '', $request->old_image);
            #Using storage
            if(Storage::exists('public/blogs/' . $Image)){
               $delete= Storage::delete('/public/blogs/' . $Image);
            }
        } 
        $blogs->cat_id=$request->cat_id;
        $blogs->title=$request->title;
        $blogs->slug=$request->slug;
        $blogs->description=$request->description;
        $blogs->meta_title=$request->meta_title;
         $blogs->alt_image=$request->alt_image;
        $blogs->meta_keywords=$request->meta_keywords;
          $blogs->meta_description=$request->meta_description;
        $blogs->updated_at=date('Y-m-d H:m:s');
        $blogs->update();
        alert::success('Blog Updated Successfully');
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
        $blogs=Blog::find($id);
        if($blogs->image)
        {
            if(Storage::exists('public/blogs/' . $blogs->image)){
            $delete= Storage::delete('/public/blogs/' . $blogs->image);   
             }
        }
        $blogs->delete();
        alert::success('blogs Deleted Successfully');
        return redirect()->back();
    }
    public function ckUpload(Request $request)
    {
        $file=$request->upload;
        $filename=$file->getClientOriginalName();
        $new_name=time().$filename;
        $dir="ckeditor/images/";
       $file->move($dir,$new_name);
       $url=asset('ckeditor/images/'.$new_name);
      $CkeditorFuncNum=$request->input('CKEditorFuncNum');

         $status="<script>window.parent.CKEDITOR.tools.callFunction('$CkeditorFuncNum','$url','File Uploaded Succesfully')</script>";
       echo $status;
       return response()->$status;

     }  

     public function Getslug()
     {
         $slug=SlugService::createSlug(Blog::class,'slug',request('title'));
         return response()->json(['blog_slug'=>$slug]);
     }

     //Blog Description
     public function BlogDescription($id)
     {
        $desc=Blog::select('description')->where('id',$id)->first();
        return $desc;
     }
       public function Comments()
    {
        $comments = BlogComment::get();
        return view('admin.blogs.comments', compact('comments'));
    }
    public function postcommentdelete($id)
    {
         $comments=BlogComment::find($id);
        $comments->delete();
        alert::success('$comment Deleted Successfully');
        return redirect()->back();
    }
}
