<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\file;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Product;
use Cviebrock\EloquentSluggable\Services\SlugService;
class CategoryController extends Controller
{
    public function index()
    {
        $trending_categories= category::where('popular','1')->get();
        $categories=Category::all();
        return response()->json(['categories'=>$categories,'trending_categories'=>$trending_categories], 200);
    }
    public function show_products($slug)
    {
        $category=Category::select('id')->where('slug',$slug)->first();
        $cat_products=Product::where('cat_id',$category->id)->get();
        return response()->json(['cat_products'=>$cat_products], 200);
    }
    //All Brands showing
    public function AllBrands()
    {
           $expirationTime = 60;
    // Check if the cached response exists
      if (cache()->has('brands_cache')) {
         $brands = cache()->get('brands_cache');
      } else {
        $brands=Brand::select('brand_name','id','slug')->orderBy('brand_name','asc')->take(18)->get();
         cache()->put('brands_cache', $brands, $expirationTime);
      }
        return response()->json(['brands'=>$brands], 200);

    }

    //Show Brands Products
    public function BrandsProducts($slug)
    {
        
            $brands=Brand::where('slug',$slug)->first();
            if(!is_null($brands)){
            $brand_products=Product::where('brand_id',$brands->id)->get();
            return response()->json(['brand_products'=>$brand_products,'brands'=>$brands], 200);
        }else{
            return response()->json(['Prouct Not Found'], 201);
        }
     
    }
}
