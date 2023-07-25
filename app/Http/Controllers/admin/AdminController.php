<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Review;
use App\Models\Ads;
use App\Models\Currency;
use App\Models\Product;
use App\Models\User;
use App\Models\Newslatter;
use App\Models\AttributeValue;  
use App\Models\Attribute_Values;  
use App\Models\Attribute;
use App\Models\Comment;
use App\Models\Permission;
use App\Models\Feature;
use App\Models\RoleHasPermission;
use App\Models\CommentReply;
use Illuminate\Support\Facades\file;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Auth;
use Session;
class AdminController extends Controller
{
    public function index()
    {
        $total_products=Product::count();
        $total_users=User::count();
        $newslatter_users=Newslatter::count();
        $total_clicks=Product::select('click_count')->sum('click_count');
        
        $user= User::where('id',Auth::user()->id)->first();
        $role_id= $user->user_role->first()->role_id;
        $permissions = RoleHasPermission::select('role_has_permissions.*','permissions.name')
        ->leftjoin('permissions','permissions.id','role_has_permissions.permission_id')
        ->where('role_has_permissions.role_id',$role_id)
        ->get(); 
          $permissions = $permissions->pluck('name'); 
           Session::put('permissions',$permissions);
      
        return view('dashboard',compact('total_products','total_users','total_clicks','newslatter_users'));
    }
    public function home()
    {
        $Currency=Currency::all();
        $products=Product::with('category','brands','features')->orderBy('created_at','DESC')->get();
        $cuurency=0;
        $popular=Product::where('trending',1)->orderBy('created_at', 'DESC')->get();
        
        return view('welcome',compact('products','popular'));
    }
    //add products
    public function add_products()
    {
        $category=Category::all();
  
        return view('admin.products.index',['category'=>$category]);
    }
    public function Ads()
    {
        $ads=Ads::all();
        return view('admin.ads.index',compact('ads'));
    }
    public function AdsStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'size'=>'required',
            //  'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
           
            $data=[
                'title'=>$request->title,
                'description'=>$request->description,
                'status'=>1,
                'size'=>$request->size,
                'image_status'=>$request->image_status,
                'html_code'=>$request->html_code,
                'created_at'=>date('Y-m-d H:m:s')
            ];
           
            if($request->hasFile('image'))
            {
                 $file = $request->file('image');
                    $imageName = $file->getClientOriginalName();
            //   $imageName = time().'.'.$request->image->extension(); 
                $path = $request->file('image')->storeAs('public/adds',$imageName);
            //   $request->image->storeAs('public/ads', $imageName);
              $data['image'] = $imageName;
            
            }else{
                $data['image']=''  ;
            }
           
            $item = Ads::insert($data);
            if($item){
            alert::success('Ads Added Successfully');
            return redirect()->back();
         }else{
            alert::success('ads Not Added');
            return redirect()->back();
         }
    }
    // Ads Update
    public function AdsUpdate(Request $request)
    {
       
        $Ads=Ads::find($request->id);
        if($request->hasFile('image')) {
            $file_name = time().'.'.$request->image->extension(); 
            $path = $request->file('image')->storeAs('public/adds',$file_name);
        $Ads->image=$file_name;
            $Image = str_replace('/storage', '', $request->old_image);
            #Using storage
            if(Storage::exists('public/adds/' . $Image)){
               $delete= Storage::delete('/public/adds/' . $Image);
            }
        } 
         $Ads->title=$request->title;
        $Ads->title=$request->title;
        $Ads->description=$request->description;
        $Ads->size=$request->size;
        $Ads->html_code=$request->html_code;
        $Ads->updated_at=date('Y-m-d H:m:s');
        $Ads->update();
        alert::success('Slider Updated Successfully');
        return redirect()->back();
    }

// Ads Delete
public function AdsDelete($id)
{
    $Ads=Ads::find($id);
    if($Ads->image)
    {
        if(Storage::exists('public/ads/' . $Ads->image)){
        $delete= Storage::delete('/public/adds/' . $Ads->image);   
         }
    }
    $Ads->delete();
    alert::success('Ads Deleted Successfully');
    return redirect()->back();
   }
     //Currency 
     public function Currency()
     {
        $Currency=Currency::all();
        return view('admin.currency.index',compact('Currency'));
     }
   //Currency Store
   public function CurrencyStore(Request $request)
   {
       $request->validate([
           'name' => 'required',
           'price'=>'required',
           'currency_date'=>'required',
           ]);
   
           $data=[
               'name'=>$request->name,
               'price'=>$request->price,
               'country'=>$request->country,
               'date'=>$request->currency_date,
               'created_at'=>date('Y-m-d H:m:s')
           ];
            if($request->hasFile('image'))
            {
               $imageName = time().'.'.$request->image->extension(); 
                $path = $request->file('image')->storeAs('public/currency',$imageName);
            //   $request->image->storeAs('public/ads', $imageName);
              $data['flag_icon'] = $imageName;
            
            }else{
                $imageName=''  ;
            }
           $item = Currency::insert($data);
           if($item){
           alert::success('currency Added Successfully');
           return redirect()->back();
        }else{
           alert::success('currency Not Added');
           return redirect()->back();
        }
   }
   //Currency Update
   public function CurrencyUpdate(Request $request)
   {
    // $data=[
    //     'name'=>$request->name,
    //     'country'=>$request->country,
    //     'price'=>$request->price,
    //     'date'=>$request->currency_date,
    //     'updated_at'=>date('Y-m-d H:m:s')
    // ];
    // $update= Currency::where('id', $request->currency_id)->update($data);
    
    $Currency=Currency::find($request->currency_id);
        if($request->hasFile('image')) {
            $file_name = time().'.'.$request->image->extension(); 
            $path = $request->file('image')->storeAs('public/currency',$file_name);
            $Currency->flag_icon=$file_name;
            $Image = str_replace('/storage', '', $request->old_image);
            #Using storage
            if(Storage::exists('public/currency/' . $Image)){
               $delete= Storage::delete('/public/currency/' . $Image);
            }
        } 
        $Currency->name=$request->name;
        $Currency->country=$request->country;
        $Currency->price=$request->price;
        $Currency->date=$request->currency_date;
        $Currency->updated_at=date('Y-m-d H:m:s');
        $Currency->update();
    alert::success('currency Updated Successfully');
    return redirect()->back();
   }
   //Currency Delete
   public function CurrencyDelete($id)
   {
    $Currency=Currency::find($id);
    $Currency->delete();
    alert::success('Currency Deleted Successfully');
    return redirect()->back();
   }
// ////////////////////////////TEST EAREA ////////////////////////////////////////////////////////////
public function test()
{
    
   $Currency=Currency::all();
    $products=Product::with('category','brands')->orderBy('created_at','desc')->get();
    $cuurency=0;
   

    return view('welcome',compact('products','Currency','cuurency','popular'));
}
public function ProductView($slug)
{
    $id=Product::select('id','click_count')->where('slug',$slug)->first();
    if(!$id){
        $count=0;
    }else{
        $count=$id->click_count;
    }
    $data=[
        'click_count'=>$count+1,
    ];
    $update= Product::where('id', $id->id)->update($data);
    $pro=Product::whereSlug($slug)
    ->with('category:id,name',
    'brands:id,slug',
     'comments.user:id,name',
    'comments.replies.user:id,name',
    'attribute_values',
    'comments.replies.replies.user:id,name')
    ->with('features')
    ->orderBy('id','DESC')
    ->first();
    $browse_by=Product::select('name','image','orignal_price','id','slug')->where('brand_id',$pro->brands->id)->get();

    $groups=Attribute::with('values','values.attribute_values')->get();
    $Currency=Currency::all();
    $cuurency=0;
    $features=Feature::select('feature_name','id','feature_icon')->get();
        return view('frontend.product_view',compact('features','pro','groups','browse_by','Currency','cuurency'));
    }
    // Comments Save
    public function CommentsSave(Request $request)
    {
        
        $request->validate([
            'comment'=>'required',
        ]);
        // if(auth()->user()){
        $input=[
            'user_id'=>$request->user()->id,
            'product_id'=>$request->product_id,
            'parent_id'=>$request->parent_id,
            'comment'=>$request->comment,
        ];
        Comment::create($input);
        alert::success('Comment Added Successfully');
            return redirect()->back();
            $message='Comment Added Succesfully';
             return response()->json(['mesage'=>$message], 200);
    // }else{
    //     alert::success('Please Login First');
    //     return redirect()->back();
    // }
    }
    // Comments Reply Save
    public function ChangeCurrency(Request $request)
    {
          
        //    session('data')->flush();
          
        //  $request->session()->flush();
         $request->session()->forget('data');
         $cuurency=Currency::select('name','price')->where('id',$request->id)->first();
           $data=session(['data'=>$cuurency]);
          return response()->json($data);
    }
    public function autocomplete(Request $request)
    {
        $res = Product::select("name")
                ->where("name","LIKE","%{$request->name}%")
                ->limit(10)
                ->get();
    
        return response()->json($res);
    }
      
    public function ShowComment()
    {
       $comment= Comment::all();
        return view('admin.reviews.comment',compact('comment'));
    }
    public function DeleteComment($id)
    {
        $comments=Comment::find($id);
        $comments->delete();
        alert::success('$comment Deleted Successfully');
        return redirect()->back();
    }
 
}
