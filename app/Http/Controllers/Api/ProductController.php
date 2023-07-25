<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\file;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\AttributeValue;  
use App\Models\Attribute_Values;  
use App\Models\Attribute;
use App\Models\Feature;
use App\Models\LikeDislike;
use App\Models\FeatureValue;
use Cviebrock\EloquentSluggable\Services\SlugService;
use DB;
class ProductController extends Controller
{
    //Show All Products
public function index()
{
    $expirationTime = 60;
    // Check if the cached response exists
     if (cache()->has('products_cache')) {
         $products = cache()->get('products_cache');
     } else {
        // Retrieve the products from the database if not found in the cache
        $products = Product::select('name','slug','description','image','orignal_price','ram','storage','battery','id')->orderBy('created_at', 'desc')->paginate(12);

        // Cache the products response
        cache()->put('products_cache', $products, $expirationTime);
     }

    return response()->json(['products' => $products], 200);
}

    public function popular()
    {
          $popular_products=Product::orderBy('click_count', 'desc')->paginate(10);
           $max_click_products=Product::orderBy('click_count', 'desc')->get();
        return response()->json(['$popular_products'=>$popular_products,'max_click_products'=>$max_click_products], 200);
    }
    public function get_products(Request $request)
    {
        // popular_products=Product::select('name','id','slug')->all(4);
        $products=DB::table('products')->select('name','slug','id')->where('name','LIKE','%'.$request->name."%")->get();
        return response()->json(['$products'=>$products], 200);
    }
        public function trending()
    {
       
             $expirationTime = 60;
    // Check if the cached response exists
     if (cache()->has('trending_products_cache')) {
         $trending_products = cache()->get('trending_products_cache');
     } else {
        // Retrieve the products from the database if not found in the cache
          $trending_products=Product::where('trending','1')->orderBy('created_at', 'desc')->get();

        // Cache the products response
        cache()->put('trending_products_cache', $trending_products, $expirationTime);
     }
        return response()->json(['$trending_products'=>$trending_products], 200);
    }
     public function upcoming()
    {
        $expirationTime = 60;
           if (cache()->has('upcomming_products_cache')) {
         $upcoming_products = cache()->get('upcomming_products_cache');
     } else {
          $upcoming_products=Product::where('upcoming','1')->orderBy('created_at', 'desc')->get();
           cache()->put('upcomming_products_cache', $upcoming_products, $expirationTime);
     }
        return response()->json(['$upcoming_products'=>$upcoming_products], 200);
    }
      public function groups()
    {
          $groups=Attribute::with('values')->get();
        return response()->json(['$groups'=>$groups], 200);
    }
     public function features()
    {
          $features=Feature::with('feature_value')->get();
        return response()->json(['$features'=>$features], 200);
    }
    public function Compares($one,$two)
    {
    $products = Product::whereIn('slug', [$one, $two])
    ->with('category:id,name', 'brands:id,slug', 'comments.user:id,name', 'comments.replies.user:id,name', 'attribute_values.group_values', 'features.feature', 'comments.replies.replies.user:id,name')
    ->get();

$first_product = $products->firstWhere('slug', $one);
$second_product = $products->firstWhere('slug', $two);

    return response()->json(['first_product'=>$first_product,'second_product'=>$second_product], 200);
    }
   public function mulitple()
{
     $expirationTime = 60;
    // Check if the cached response exists
     if (cache()->has('multiple_products_cache')) {
         $cachedResponse = cache()->get('multiple_products_cache');
         $products_one = $cachedResponse['products_one'];
         $products_two = $cachedResponse['products_two'];
         $products_three = $cachedResponse['products_three'];
     } else {
        // Retrieve the products from the database if not found in the cache
        $products_one = Product::orderBy('created_at', 'desc')->limit(2)->get();
        $products_two = Product::where('popular', 1)->orderBy('created_at', 'desc')->limit(2)->get();
        $products_three = Product::where('trending', 1)->orderBy('created_at', 'desc')->limit(2)->get();

        // Cache the products response
        $cachedResponse = [
            'products_one' => $products_one,
            'products_two' => $products_two,
            'products_three' => $products_three,
        ];
        cache()->put('multiple_products_cache', $cachedResponse, $expirationTime);
     }

    return response()->json(['products_one' => $products_one, 'products_two' => $products_two, 'products_three' => $products_three], 200);
}

   //SHow One Products upcoming
    // public function show($slug)
    // {
    //     $pro=Product::whereSlug($slug)
    //     ->with('category:id,name',
    //     'brands:id,slug',
    //      'comments.user:id,name',
    //     'comments.replies.user:id,name',
    //      'attribute_values.group_values',
    //     'comments.replies.replies.user:id,name')
    //     ->first();
    //     return $pro;
    // }
  ///Search Product
    public function search($name)
    {
         $search_Product=Product::select('name','slug','orignal_price','image','id')->where('name', 'like', '%'.$name.'%')->get();
         
         return response()->json(['search_Product'=>$search_Product], 200);
    }
    //price_finder
    public function price_finder(Request $request)
    {
      $price_wise_product=Product::when($request->from, function ($query) use ($request) {
            return $query->whereBetween('orignal_price', [$request->from, $request->to]);
        })->get();
         return response()->json(['$price_wise_product'=>$price_wise_product], 200);
    }
        public function RamProducts($ram)
    {
      $ram_product=Product::where('ram',$ram)->get();
         return response()->json(['ram_product'=>$ram_product], 200);
    }
    //     $groups=Attribute::with('values.attribute_values')->get();
    // $features=Feature::select('feature_name','id','feature_icon')->get();
    //Trending Products
 public function ProductView($slug)
     {
    $id=Product::select('id','click_count','brand_id')->where('slug',$slug)->first();
    if($id){
          $data=[
        'click_count'=>$id->click_count+1,
        
    ];
     $update= Product::where('id', $id->id)->update($data);
    }
  
   
// $single_product = Product::whereSlug($slug)
//     ->with('category:id,name',
//     'brands:id,slug',
//     'comments.user:id,name',
//     'comments.replies.user:id,name',
//     'attribute_values.group_values',
//     'features.feature',
//     'images',
//     'comments.replies.replies.user:id,name',
//     'commentsWithLikesAndDislikes') // Eager load the comments with likes and dislikes
//     ->first();
$single_product = Product::whereSlug($slug)
    ->with(['category:id,name', 'brands:id,slug', 'attribute_values.group_values', 'features.feature', 'images', 'commentsWithLikesAndDislikes', 'comments.user:id,name', 'comments.replies' => function ($query) {
        $query->with('user:id,name', 'replies.user:id,name')->chunk(100);
    }])
    ->first();

    $browes_product=Product::select('name','slug','id','image','orignal_price')->where('brand_id',$id->brand_id)->limit(5)->get();


    return response()->json(['single_product'=>$single_product,' $browes_product'=>$browes_product], 200);
    }
    //Compare This Products
    public function CompareThisProducts($slug)
    {
        $compare_product1=Product::where('slug',$slug)->first();
        return response()->json(['compare_product1'=>$compare_product1], 200);

    }

     //Compare To Products
     public function CompareToProducts($slug)
     {
         $compare_product2=Product::where('slug',$slug)->first();
         return response()->json(['compare_product2'=>$compare_product2], 200);
 
     }
     //BrowseBudgetProducts
     public function BrowseBudgetProducts($price)
     {
         $budget_products=Product::whereBetween('orignal_price', [0, $price])->get();
         return response()->json(['budget_products'=>$budget_products], 200);
     }
        public function save_likedislike(Request $request)
     {
         if (auth()->check()) {
         $LikeDislike= LikeDislike::where('user_id', $request->user_id)->where('comment_id',$request->id)->first();
         if($LikeDislike){
             return response()->json([
                'Warning'=>'you have once add your reaction',
            ]);
         }else{
              $data=new LikeDislike;
            $data->comment_id=$request->id;
            if($request->type=='like'){
                $data->like=1;
     
            }else{
                $data->dislike=1;
            }
            $data->user_id=$request->user_id;
            $data->save();
            $likes=LikeDislike::select('like')->sum('like');
            $dislikes=LikeDislike::select('dislike')->sum('dislike');
            return response()->json([
                'likes'=>$likes,
                'dislikes'=>$dislikes,
            ]);
         }
     } else {
        return response()->json(['message' => 'Please log in.'], 401);
    }
         }
     


}
