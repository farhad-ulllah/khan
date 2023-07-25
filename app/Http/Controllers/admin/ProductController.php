<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\file;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Brand;          
use App\Models\AttributeValue;  
use App\Models\Attribute_Values;  
use App\Models\Attribute;
use App\Models\ProductImage;
use App\Models\Filter;
use App\Models\User;
use App\Models\LikeDislike;
use App\Models\ProductFilterValue;
use Illuminate\Support\Str;
use App\Notifications\ProductCreated;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Feature;
use App\Models\FeatureValue;
use Auth;
use Illuminate\Support\Facades\Redirect;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->permission('view products')) {
        $products= Product::orderBy('created_at', 'DESC')->get();
        return view('admin.products.index',compact('products'));
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
        $category=Category::all();
        $product=Product::select('id','name')->get();
        $brands=Brand::all();
        $groups=Attribute::all();
        $filters=Filter::all();
        $features=Feature::select('feature_name','id')->get();
        $productid=Product::select('id')->orderBy('id','DESC')->first();
        if($productid){
            $product_id=$productid->id;
        }else{
            $product_id=1;          
        }

        return view('admin.products.create',compact('product','category','brands','groups','filters','features','product_id'));
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
            'name' => 'required',
            'cat_id'=>'required',
            'slug' => 'required|unique:products',
             'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'images' => 'required',
            // 'images.*' => 'mimes:jpeg,jpg,png,gif|max:2048',
        ]);
  
        if($request->hasFile('image'))
        {
        //   $imageName = time().'.'.$request->image->extension(); 
        $file = $request->file('image');
             $imageName = $file->getClientOriginalName();
          $request->image->storeAs('public/product', $imageName);
          
        }else{
            $imageName=''  ;
        }
        $tagse = explode(",", $request->tag);
        $productAdded = Product::create([
            'name' => $request->name,
            'slug' =>Str::slug($request->slug),
            'description' => $request->description,
            'orignal_price'=>$request->price,
            'selling_price' => $request->selling_price,
            'cat_id'=>$request->cat_id,
            'small_description'=>$request->small_description,
            'qty' => $request->quantity,
            'tax' => $request->tax,
            'status' =>1,
            'trending' => $request->trending==true ? '1':'0',
            'upcoming' => $request->upcoming==true ? '1':'0',
            'popular' => $request->popular==true ? '1':'0',
            'image'=>$imageName,
            'meta_title' => $request->meta_title,
            'meta_description'=>$request->meta_description,
            'meta_keywords'=>$request->meta_keywords,
            'alt_image'=>$request->alt_image,
            'brand_id'=>$request->brand_id,
            'ram'=>$request->ram,
            'storage'=>$request->storage,
            'battery'=>$request->battery,
          'video_host'=>$request->video_host,
          'video_link'=>$request->video_link,
          'ram_storage1'=>$request->ram_storage1,
          'ram_storage2'=>$request->ram_storage2,
          'ram_storage3'=>$request->ram_storage3,
         'ram_storage1_price'=>$request->ram_storage1_price,
         'ram_storage2_price'=>$request->ram_storage2_price,
         'ram_storage3_price'=>$request->ram_storage3_price,
            'created_at'=>date('Y-m-d H:m:s'),
        ]);
        
    	$tags = explode(",", $request->tag);
    	$productAdded->tag($tags);
        //Add Features
 
         $product_id=Product::select('id')->orderBy('id','DESC')->first();
                if(!empty($request->feature)){
         foreach($request->feature as $key3=>$feature)
         {
                 $feature_data=[
                    'feature_id'=>$key3,
                     'product_id'=>$product_id->id,
                    'feature_value'=>$feature,
                 ];
                 $feature_insert = FeatureValue::insert($feature_data);
         }
                }
                
        //Add Filters
               if(!empty($request->filter_value)){
        foreach($request->filter_value as $key=>$filter)
            {
                foreach($filter as $key1=>$val)
                {
                    $filter_data=[
                        'filter_values_id'=>$key,
                        'product_filter_id'=>$key1,
                        'product_id'=>$product_id->id,
                        'product_filter_value'=>$val,
                    ];
                    $insert = ProductFilterValue::insert($filter_data);
                }
            }
               }
            //Add Gallery
                   if(!empty($request->File('images'))) {
              foreach($request->File('images') as $img){
        // $imageName = time().'.'.$img->extension(); 
        $imageName =$img->getClientOriginalName(); 
        $imgPath=$img->storeAs('public/product/images', $imageName);
        // $imgPath=$img->store('public/product/images');
        $imgData=new ProductImage;
        $imgData->product_id=$product_id->id;
        $imgData->image=$imageName;
        $imgData->image_title=$request->image_title;
        $productAdded= $imgData->save();
               }
                   }
              if(!empty($request->attribute_val)){       
        foreach($request->attribute_val as $key1=>$val)
            {
                foreach($val as $key=>$item)
                {
                    // if($item!==null){
                    $data_1=[
                        'group_id'=>$key1,
                        'attribute_value_id'=>$key,
                        'attribute_value'=>$item,
                        'product_id'=>$product_id->id,
                    ];
                    $item = Attribute_Values::insert($data_1);
                }
                }
            }
            
    if($productAdded){
        alert::success('Product Added Successfully');
        return redirect()->back();
    }else{
        alert::success('Product Not Added');
        return redirect()->back();
    }
      
    }
    // Product Features Store Start
    // public function ProductFeaturesStore(Request $request)
    // {
       
    // } 
    // Product Features Store End
        public function destroy_images($img_id)
        {
            $data=ProductImage::where('id',$img_id)->first();
            Storage::delete($data->image);
    
            ProductImage::where('id',$img_id)->delete();
           return response()->json(['bool'=>true]);
        }

        // Product Gallery Store Start
        public function productsGalleryStore(Request $request)
        {
            $request->validate([
                'images' => 'required',
                'images.*' => 'mimes:jpeg,jpg,png,gif|max:2048'
              ]);
            
               if($productAdded){
                alert::success('Product Images Added Successfully');
                return redirect()->back();
            }else{
                alert::success('Product Not Added');
                return redirect()->back();
            }
        }
        //add   Gallery Image End

        // products Videos Store Function Start
        public function productsattributes(Request $request)
        {
           

          
            if($item){
                alert::success('Attribute  Added Successfully');
                return redirect()->back();
            }else{
                alert::success('Please Add Values ');
                return redirect()->back();
            }
        }
        //products Features Store 
        public function productsFiltersStore(Request $request)
        {
            //    function For Add Product FIlter Start
    
            if($insert){
                alert::success('Filters  Added Successfully');
                return redirect()->back();
            }else{
                alert::success('Product Not Added');
                return redirect()->back();
            }
    //function For Add Product FIlter End
        }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Product::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
        $groups=Attribute::all();
         $filters = Filter::with('filter_value')->get();
        //  $filters=Filter::all();  
        $products=Product::with('product_filters')->with('features')->find($id);
        // dd($products);
        $category=Category::all();
        $brands=Brand::all();
        $features=Feature::select('feature_name','id as feature_id')->with('feature_value')->get();
        return view('admin.products.edit',compact('features','products','category','brands','groups','filters'));
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
                    $products=Product::find($id);
                    $product_tag=Product::find($id);
                    if($request->hasFile('image')) {
                        // $file_name = time().'.'.$request->image->extension();
                        $file = $request->file('image');
                       $file_name = $file->getClientOriginalName();
                        $path = $request->file('image')->storeAs('public/product',$file_name);
                        $products->image=$file_name;
                        
                        $Image = str_replace('/storage', '', $request->old_image);
                        // dd($Image);
                        #Using storage
                        if(Storage::exists('public/product/' . $Image)){

                        $delete= Storage::delete('/public/product/' . $Image);
                        
                        }
                    } 
                    $products->cat_id=$request->cat_id;
                     $products->brand_id=$request->brand_id;
                    $products->name=$request->name;
                    $products->slug=$request->slug;
                    $products->alt_image=$request->alt_image;
                    $products->description=$request->description;
                    $products->small_description=$request->small_description;
                    $products->orignal_price=$request->price;
                    // $products->selling_price=$request->selling_price;
                    $products->qty=$request->quantity;
                    // $products->tax=$request->tax;
                    // $products->tags=$request->tag;
                    $products->trending=$request->popular;
                    $products->meta_title=$request->meta_title;
                    $products->meta_keywords=$request->meta_keywords;
                    $products->meta_description=$request->meta_description;
                    $products->status=$request->status==true ? '1':'0';
                    $products->trending=$request->trending==true ? '1':'0';
                    $products->upcoming=$request->upcoming==true ? '1':'0';
                    $products->popular=$request->popular==true ? '1':'0';
                    $products->video_host=$request->video_host;
                    $products->video_link=$request->video_link;
                    $date=date('Y-m-d', strtotime($request->product_date));
                    $new_date=date('H:i:s');
                    $products->ram=$request->ram;
                    $products->storage=$request->storage;
                    $products->battery=$request->battery;
                    $products->ram_storage1=$request->ram_storage1;
                    $products-> ram_storage2=$request->ram_storage2;
                    $products->ram_storage3=$request->ram_storage3;
                    $products->ram_storage1_price=$request->ram_storage1_price;
                    $products->ram_storage2_price=$request->ram_storage2_price;
                    $products->ram_storage3_price=$request->ram_storage3_price;
                    $products->created_at=$date.' '.$new_date;
                    $products->updated_at=date('Y-m-d H:i:s');
                    $products->update();
                    $tags = explode(",", $request->tag);
                    $product_tag->untag(); //remove old tags
                    $product_tag->tag($tags); // add new tags
                    $product_tag->save; // I find that this seems to "commit" tags and refresh the object
                   
                    if(!empty($request->newfilter_value)){
                    foreach($request->newfilter_value as $key=>$filter)
                    {
                     
                        $chek=ProductFilterValue::where('product_id', $id)->where('product_filter_id',$key)->first();
                        if($chek){
                        $filter_data=[
                            'filter_values_id'=>$filter,
                                'updated_at'=>date('Y-m-d H:m:s')
                        ];
                        $update= ProductFilterValue::where('product_id', $id)->where('product_filter_id',$key)->update($filter_data);
                    }else{
                        $filter_add_data=[
                            'filter_values_id'=>$filter,
                            'product_id'=>$id,
                            'product_filter_id'=>$key,
                            'created_at'=>date('Y-m-d H:m:s'),
                            'updated_at'=>date('Y-m-d H:m:s')
                        ];
                        $insert = ProductFilterValue::insert($filter_add_data);
                    }
                }
                    }
                    if(!empty($request->attribute_val)){
                    foreach($request->attribute_val as $key1=>$val)
                    {
                        foreach($val as $key=>$item)
                        {
                            
                            $data_values=[
                                'attribute_value'=>$item,
                                'updated_at'=>date('Y-m-d H:i:s')
                            ];
                            $attr_value=Attribute_Values::where('attribute_value_id',$key)->where('product_id', $id)->first();
                            if($attr_value){
                                $update= Attribute_Values::where('product_id', $id)->where('attribute_value_id',$key)->update($data_values);
                            }else{
                                $data_value=[
                                    'attribute_value'=>$item,
                                    'product_id'=>$id,
                                    'attribute_value_id'=>$key,
                                    'group_id'=>$key1,
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s')
                                ];
                                $itemvalue = Attribute_Values::insert($data_value);
                            }
                           
                        }
                    }
                 }
                            //multiple_images
                 if(!empty($request->multiple_images)){
                 foreach($request->File('multiple_images') as $img){
                    $imageName =$img->getClientOriginalName(); 
                    $imgPath=$img->storeAs('public/product/images', $imageName);
                    $imgData=new ProductImage;
                    $imgData->product_id=$id;
                    $imgData->image=$imageName;
                    $imgData->image_title=$request->gallery_image_title;
                    $productAdded= $imgData->save();
                           }
                        }
                 //End multiple_images
                // dd($request->feature);
                        if(!empty($request->feature)){
                            foreach($request->feature as $key3=>$feature)
                            {
                                if($feature!==null)
                              {
                                    $chek=FeatureValue::where('product_id', $id)->where('feature_id',$key3)->first();
                                    if($chek){
                                        $feature_data=[
                                            'feature_value'=>$feature,
                                        ];
                                        $featureupdate= FeatureValue::where('product_id', $id)->where('feature_id',$key3)->update($feature_data);
                                    }else{
                                        $feature_add_data=[
                                            'feature_value'=>$feature,
                                            'feature_id'=>$key3,
                                            'product_id'=>$id,
                                        ];
                                        $add=FeatureValue::insert($feature_add_data);
                                    }
                               }
                            
                            }
                        }
                            alert::success('Product Updated Successfully');
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
        $products=Product::find($id);
        if($products->image)
        {
            if(Storage::exists('public/product/' . $products->image)){
            $delete= Storage::delete('/public/product/' . $products->image);   
             }
        }
        $products->delete();
        alert::success('product Deleted Successfully');
        return redirect()->back();
    }
    public function search($name)
    {
        return Product::where('name', 'like', '%'.$name.'%')->get();
    }
    public function getslug()
    {
       $slug=SlugService::createSlug(Product::class,'slug',request('name'));
       return response()->json(['slug'=>$slug]);
    }
    public function duplicate_product($id)
    {
        $groups=Attribute::all();
        $filters = Filter::with('filter_value')->get();
       //  $filters=Filter::all();  
       $products=Product::with('product_filters')->with('features')->has('product_filters')->find($id);
       if(!$products){
                  $products=Product::with('product_filters')->with('features')->find($id);
       }
   
       $category=Category::all();
       $brands=Brand::all();
     
       $features=Feature::select('feature_name','id as feature_id')->with('feature_value')->get();

       return view('admin.products.duplicate',compact('features','products','category','brands','groups','filters'));
    }
    public function Duplicate_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cat_id'=>'required',
            'slug' => 'required|unique:products',
            //  'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // dd($request->get('atribute_' . $request->attribute_id));
      
        if($request->hasFile('image'))
        {
        //   $imageName = time().'.'.$request->image->extension(); 
              $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
          $request->image->storeAs('public/product', $imageName);
          
        }
        else{
          
            $imageName =$request->old_image1; 
            // Storage::copy('public/product/'.$imageName,'public/product/'.$imageName);
            Storage::put('public/product', $imageName);
            // Storage::move('public/product/'.$imageName,'public/product/'.$imageName);
            // $request->old_image1->storeAs('public/public', $imageName);
        }
        $tagse = explode(",", $request->tag);
        $productAdded = Product::create([
            'name' => $request->name,
            'slug' =>Str::slug($request->slug),
            'description' => $request->description,
            'orignal_price'=>$request->price,
            'selling_price' => $request->selling_price,
            'cat_id'=>$request->cat_id,
            'small_description'=>$request->small_description,
            'qty' => $request->quantity,
            'tax' => $request->tax,
            'status' =>1,
            'trending' => $request->trending==true ? '1':'0',
            'upcoming' => $request->upcoming==true ? '1':'0',
            'popular' => $request->popular==true ? '1':'0',
            'image'=>$imageName,
            'meta_title' => $request->meta_title,
            'meta_description'=>$request->meta_description,
            'meta_keywords'=>$request->meta_keywords,
            'brand_id'=>$request->brand_id,
            'video_host'=>$request->video_host,
            'video_link'=>$request->video_link,
            'ram'=>$request->ram,
            'storage'=>$request->storage,
             'battery'=>$request->battery,
          'ram_storage1'=>$request->ram_storage1,
          'ram_storage2'=>$request->ram_storage2,
          'ram_storage3'=>$request->ram_storage3,
          'ram_storage1_price'=>$request->ram_storage1_price,
          'ram_storage2_price'=>$request->ram_storage2_price,
          'ram_storage3_price'=>$request->ram_storage3_price,
        ]);
    	$tags = explode(",", $request->tag);
    	$productAdded->tag($tags);
    // inserting Product Features
    $product_id=Product::select('id')->orderBy('id','DESC')->first();
    
  if(!empty($request->feature)){
    foreach($request->feature as $key3=>$feature)
    {
            $feature_data=[
                'feature_id'=>$key3,
                'product_id'=>$product_id->id,
                'feature_value'=>$feature,
            ];
            $feature_insert = FeatureValue::insert($feature_data);
    }
  }
    //End For Product Features
    //    function For Add Product FIlter Start
      if(!empty($request->filter_value)){
    foreach($request->filter_value as $key=>$filter)
    {
        foreach($filter as $key1=>$val)
        {
           
            $filter_data=[
                'filter_values_id'=>$key,
                'product_filter_id'=>$key1,
                'product_id'=>$product_id->id,
                'product_filter_value'=>$val,
            ];
            $insert = ProductFilterValue::insert($filter_data);
        }
       
    }
      }
    //function For Add Product FIlter End
    
    //function For  Gallery Image Start
    if($request->File('images')){
    foreach($request->File('images') as $img){
        $imageName = time().'.'.$img->extension(); 
        $imgPath=$img->storeAs('public/product/images', $imageName);
        // $imgPath=$img->store('public/product/images');
        $imgData=new ProductImage;
        $imgData->product_id=$product_id->id;
        $imgData->image=$imageName;
        $imgData->image_title=$request->image_title;
        $imgData->save();
    }
   }else{

     $pro=Product::where('id',$request->dup_id)->first();
     foreach($pro->images as $img){
        $image_data=[
            'image'=>$img->image,
            'product_id'=>$product_id->id,
            'image_title'=>$img->image_title,
        ];
        $img_insert = ProductImage::insert($image_data);
     }

   }
//    else{
//     foreach($request->old_images as $old_img){
//         $imageName = time().'.'.$old_img->extension(); 
//         $imgPath=$old_img->storeAs('public/product/images', $imageName);
//         // $imgPath=$img->store('public/product/images');
//         $imgData=new ProductImage;
//         $imgData->product_id=$product_id->id;
//         $imgData->image=$imageName;
//         $imgData->image_title=$request->image_title;
//         $imgData->save();
//    }
//      }
    //add   Gallery Image End
     if(!empty($request->attribute_val)){
            foreach($request->attribute_val as $key1=>$val)
            {
                // dd($val);
                foreach($val as $key=>$item)
                {
                    $data_1=[
                        'group_id'=>$key1,
                        'attribute_value_id'=>$key,
                        'attribute_value'=>$item,
                        'product_id'=>$product_id->id,
                    ];
                    $item = Attribute_Values::insert($data_1);
                }
               
            }
     }
    if($productAdded){
        alert::success('Product Duplicated  Successfully');
        return Redirect::to('/products');
    }else{
        alert::success('Product Not Added');
        return redirect()->back();
    }
      
    }
    // Save Like Or dislike
    function save_likedislike($id,$type){
        
        $data=new LikeDislike;
        $data->comment_id=$id;

        if($type=='like'){
            $data->like=1;
        }else{
            $data->dislike=1;
        }
        $data->save();
        $likes=LikeDislike::select('like')->sum('like');
        $dislikes=LikeDislike::select('dislike')->sum('dislike');
        return response()->json([
            'likes'=>$likes,
            'dislikes'=>$dislikes,
        ]);
    }
    //Get Product Detail
    public function GetProductDetail($id)
    {
        $pro=Product::where('id',$id)
        ->with('category:id,name',
        'brands:id,slug',
         'comments.user:id,name',
        'comments.replies.user:id,name',
        'attribute_values',
        'comments.replies.replies.user:id,name')
        ->with('features')
        ->first();
        return $pro;
    }
}
