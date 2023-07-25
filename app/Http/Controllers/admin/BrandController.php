<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Support\Facades\file;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Services\SlugService;
class BrandController extends Controller
{
    public function index()
    {
        $Brands=Brand::all();
        return view('admin.Brand.index',['Brands'=>$Brands]);
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Brand.create');
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
            'brand_name'=>'required|unique:brands',
        ]);
        $Brands=new Brand();
        if($request->hasFile('image'))
        {
           $imageName = time().'.'.$request->image->extension(); 
           $request->image->storeAs('public/brands', $imageName);
           $Brands->image=$imageName;
        }else{
            $Brands->image='';
        }
        $Brands->brand_name=$request->brand_name;
        $Brands->slug=$request->brand_slug;
        $Brands->description=$request->brand_desc;
        $Brands->meta_title=$request->meta_title;
        $Brands->meta_keywords=$request->meta_keyword;
        $Brands->status=0;
        $Brands->meta_description=$request->meta_description;
         $Brands->alt_image=$request->alt_image;
        $added=$Brands->save();
    if($added){
        alert::success('Brands Added Successfully');
        return redirect()->back();
    }else{
        alert::error('Brand Not Added');
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
        $brand=Brand::find($id);
       return view('admin.Brand.edit',compact('brand'));
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
       
        $Brands=Brand::find($id);
       
        if($request->hasFile('image')) {
            $file_name = time().'.'.$request->image->extension(); 
            $path = $request->file('image')->storeAs('public/brands',$file_name);
            $Brands->image=$file_name;
           
            $Image = str_replace('/storage', '', $request->old_image);
            // dd($Image);
            #Using storage
            if(Storage::exists('public/brands/' . $Image)){

               $delete= Storage::delete('/public/brands/' . $Image);
              
            }
        } 
        $Brands->brand_name=$request->brand_name;
        $Brands->description=$request->brand_desc;
        $Brands->meta_title=$request->meta_title;
        $Brands->meta_keywords=$request->meta_keyword;
        $Brands->meta_description=$request->meta_description;
        $Brands->slug=$request->brand_slug;
          $Brands->alt_image=$request->alt_image;
        $Brands->update();
        alert::success('Brand Updated Successfully');
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
        $brands=Brand::find($id);
     
        if($brands->image)
        {
            if(Storage::exists('public/brands/' . $brands->image)){
            $delete= Storage::delete('/public/brands/' . $brands->image);   
             }
        }
        $brands->delete();
        alert::success('Brand Deleted Successfully');
        return redirect()->back();
    }
    //get_brand_slug
    public function get_brand_slug()
    {
        $slug=SlugService::createSlug(Brand::class,'slug',request('brand_name'));
        return response()->json(['brand_slug'=>$slug]);
    }

    public function test_felter()
    {
        $attributeoption= Attribute::with('values')->get();   
        return view('admin.reviews.test',compact('attributeoption'));
    }
    public function filters(Request $request)
    {
        
        // orWhereRaw("JSON_CONTAINS(user, ?)", [$user]);
          $items=['size'=>'S','color'=>'Red'];
          $item=json_encode($items);
        //   foreach($items as $key=>$vl)
        //   {
        //     dd($vl[$key]);
        //   }
          
        // $products=Product::whereIn('product_attributes','like',$items)->first();
        $item='S';
      
        foreach($request->product_attributes as $key=>$val)
        {
            $products=Product::whereJsonContains('product_attributes',  $val )->first();
            dd($products);
           
            // dd($request->product_attributes[$key]);
        }
       
    }
}
