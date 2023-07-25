<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Models\Ads;
use App\Models\Blog;
use App\Models\Role;
use App\Models\Brand;
use App\Models\Filter;
use App\Models\Module;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Newslatter;
use Spatie\Sitemap\Sitemap;
use App\Models\BlogCategory;
use App\Models\ModelHasRole;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\SitemapIndex;
use App\Models\ProductFilterValue;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function NewsLatterStore(Request $request)
    {
        $data = [
            'news_latter_email' => $request->news_latter_email
        ];
        $insert = Newslatter::insert($data);
        if ($insert) {
            return [
                'message' => 'News Latter Added'
            ];
        }
    }
    //currency
    public function currency()
    {
        $currency = Currency::all();
        return response()->json(['currency' => $currency], 200);
    }
    //currency
    public function currency_price($id)
    {
        $currency_price = Currency::select('price as currency_price')->where('id', $id)->first();
        return response()->json(['currency_price' => $currency_price], 200);
    }
    // $sliders=Slider::all();
    public function slider()
    {
        $sliders = Slider::all();
        return response()->json(['$sliders' => $sliders], 200);
    }
    //filters
    public function filters()
    {
        $filters = Filter::with(['filter_value' => function ($q) {
            $q->orderBy('filter_value', 'desc');
        }])->get();
        //   $filters =Filter::with('filter_value')->get();
        return response()->json(['$filters' => $filters], 200);
    }
    public function Ads()
    {
        $ads = Ads::all();
        return response()->json(['ads' => $ads], 200);
    }
    public function get_blogs()
    {
        // ->whereHas('comments')->withCount('unreviewedcovidfiles')
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return response()->json(['blogs' => $blogs], 200);
    }
    public function filters_products(Request $request)
    {
        //   foreach($request->newfilter_value as $key=>$filter)
        //             {
        $filter_produts = ProductFilterValue::whereIn('filter_values_id', $request->filter_values)->get();
        // }
        return response()->json(['filter_produts' => $filter_produts], 200);
    }
    public function roles()
    {
        $roles = Role::all();
        return response()->json(['roles' => $roles], 200);
    }
    public function phone_finder(Request $request)
    {
        // $products=ProductFilterValue::join('products','products.id','product_filter_values.product_id')
        //     ->whereIn('product_filter_values.product_filter_id',$request->filter_id)
        //     ->whereBetween('products.orignal_price', [$request->from_rate, $request->to_rate])
        //     ->where('products.brand_id',$request->brand_id)
        //     ->get();
        $reporter = [];
        foreach ($request->filters as $val) {
            $filterid = [];
            $valueid = [];
            foreach ($val as $key => $value) {
                $filterid[] = $key;
                $valueid[] = $value;
            }
            $filter_id = $filterid;
            $value_id = $valueid;
        }

        $products = Product::select('products.name', 'products.slug', 'products.image', 'products.id', 'products.orignal_price', 'products.brand_id', 'products.ram', 'products.storage', 'products.battery')
            //   ->leftjoin('product_filter_values','product_filter_values.product_id','products.id')
            ->when(isset($request->filters) && !empty($request->filters), function ($q) use ($value_id, $filter_id) {
                $q->whereHas('product_filters', function ($q) use ($value_id, $filter_id) {
                    $q->whereIn('filter_values_id', $value_id);
                    $q->whereIn('product_filter_id', $filter_id);
                });
            })
            //  ->when($request->has('filters'), function ($query) use ($value_id) {
            //     return $query->whereIn('filter_values_id',$value_id);
            // })
            //   ->when($request->has('filters'), function ($query) use ($filter_id) {
            //     return $query->whereIn('product_filter_id',$filter_id);
            // })

            ->when($request->from_price !== null && $request->to_price !== null, function ($query) use ($request) {
                return $query->whereBetween('products.orignal_price', [$request->from_price, $request->to_price]);
            })
            //  ->when(isset($request->brand_id) && !empty($request->brand_id), function ($q) use ($request) {
            //         $q->whereHas('brands', function ($q) use ($request) {
            //             $q->where('products.brand_id', $request->brand_id);
            //         });
            //     })
            ->when($request->brand_id !== null, function ($query) use ($request) {
                return $query->where('products.brand_id', $request->brand_id);
            })
            ->get();
        return response()->json(['products' => $products], 200);
    }
    public function send_message(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description,
            'title' => $request->title,
        ];
        $Review = Review::insert($data);
        if ($Review) {
            return [
                'message' => 'Message sent Successfully'
            ];
        }
    }
    public function Singleblogs($slug)
    {

        $id = Blog::select('id', 'blog_count')->where('slug', $slug)->first();
        if ($id) {
            $data = [
                'blog_count' => $id->blog_count + 1,
            ];
            //  $update= Blog::where('id', $id->id)->update($data);
            $item = DB::table('blogs')->where('id', $id->id)->update([
                'blog_count' => $id->blog_count + 1,
            ]);
        }
        $single_blog = Blog::where('slug', $slug)->with(
            'category:id,name',
            'comments.user:id,name',
            'comments.replies.user:id,name',
            'comments.replies.replies.user:id,name'
        )->first();
        return response()->json(['single_blog' => $single_blog], 200);
    }
    public function maxCount()
    {
        $blogs = Blog::orderBy('blog_count', 'desc')->get();
        return response()->json(['blogs' => $blogs], 200);
    }
    public function Notifications()
    {
        $latest_products = Product::select('name', 'slug', 'orignal_price', 'image', 'id')->orderBy('created_at', 'desc')->limit(4)->get();
        $latest_posts = Blog::select('title', 'slug', 'image', 'id')->orderBy('created_at', 'desc')->limit(4)->get();
        return response()->json(['latest_products' => $latest_products, 'latest_posts' => $latest_posts], 200);
    }
    public function Searchlist()
    {
        $searchProduct_list = Product::select('name', 'slug', 'image', 'orignal_price', 'id')->orderByRaw('RAND()')->limit(4)->get();
        $searchPost_list = Blog::select('title', 'slug', 'image', 'id')->orderByRaw('RAND()')->limit(5)->get();
        return response()->json(['searchProduct_list' => $searchProduct_list, 'searchPost_list' => $searchPost_list], 200);
    }
    public function generate()
    {
        $sitemapUrls = [];

        // Create a sitemap for products
        $productSitemap = Sitemap::create();
        $products = Product::all();
        foreach ($products as $product) {
            $url = url("/products/{$product->slug}");
            $productSitemap->add(Url::create($url)->setLastModificationDate($product->updated_at));
        }
        $productSitemap->writeToFile(public_path('product_sitemap.xml'));
        $sitemapUrls[] = url('/product_sitemap.xml');

        // Create a sitemap for brands
        $brandSitemap = Sitemap::create();
        $brands = Brand::all();
        foreach ($brands as $brand) {
            $url = url("/brands/{$brand->slug}");
            $brandSitemap->add(Url::create($url)->setLastModificationDate($brand->updated_at));
        }
        $brandSitemap->writeToFile(public_path('brand_sitemap.xml'));
        $sitemapUrls[] = url('/brand_sitemap.xml');

        // Create a sitemap for categories
        $categorySitemap = Sitemap::create();
        $categories = Category::all();
        foreach ($categories as $category) {
            $url = url("/categories/{$category->slug}");
            $categorySitemap->add(Url::create($url)->setLastModificationDate($category->updated_at));
        }
        $categorySitemap->writeToFile(public_path('category_sitemap.xml'));
        $sitemapUrls[] = url('/category_sitemap.xml');


        $imagesSitemap = Sitemap::create();
        $productImages = ProductImage::all();
        foreach ($productImages as $productImage) {
            $url = url("/product-images/{$productImage->image_title}");
            $imagesSitemap->add(Url::create($url)->setLastModificationDate($productImage->updated_at));
        }
        $imagesSitemap->writeToFile(public_path('product_images_sitemap.xml'));
        $sitemapUrls[] = url('/product_images_sitemap.xml');
        // Create a sitemap for blog categories
        $blogCategorySitemap = Sitemap::create();
        $blogCategories = BlogCategory::all();
        foreach ($blogCategories as $blogCategory) {
            $url = url("/blog-categories/{$blogCategory->slug}");
            $blogCategorySitemap->add(Url::create($url)->setLastModificationDate($blogCategory->updated_at));
        }
        $blogCategorySitemap->writeToFile(public_path('blog_category_sitemap.xml'));
        $sitemapUrls[] = url('/blog_category_sitemap.xml');

        // You can add more sitemaps for other categories if needed

        // Create the sitemap index XML
        $sitemapIndexXML = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemapIndexXML .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($sitemapUrls as $sitemapUrl) {
            $sitemapIndexXML .= '<sitemap>';
            $sitemapIndexXML .= '<loc>' . $sitemapUrl . '</loc>';
            $sitemapIndexXML .= '</sitemap>';
        }
        $sitemapIndexXML .= '</sitemapindex>';

        return response($sitemapIndexXML)->header('Content-Type', 'text/xml');
    }
}
