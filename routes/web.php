<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\AttributeController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\ReviewController;
use App\Http\Controllers\admin\BlogsController;
use App\Http\Controllers\admin\FilterController;
use App\Http\Controllers\admin\BlogCategoryController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\FeatureController;
/*
|--------------------------------------------------------------------------
| Web Routes   
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/storage', function () {
    Artisan::call('storage:link');
});
// Route::get('/',[AdminController::class,'home']);
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('product/{slug}',[AdminController::class,'ProductView']);
Route::get('autocomplete', [AdminController::class, 'autocomplete'])->name('autocomplete');
Route::post('comments_save',[AdminController::class,'CommentsSave'])->name('comments.store');
Route::post('user_register',[UserController::class,'store'])->name('user.add');
Route::post('comments_reply_save',[AdminController::class,'CommentsReplySave']);
Route::post('change_currency_rate',[AdminController::class,'ChangeCurrency']);
// Like Or Dislike
Route::get('save-likedislike/{id}/{type}',[ProductController::class,'save_likedislike']);

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'
])->group(function () {
    Route::get('/dashboard', [AdminController::class,'index'])->name('dashboard');
    Route::get('/front', [AdminController::class,'front'])->name('front');
   
// Route::post('cat_store',[CategoryController::class,'StoreCategory'])->name('category.store');
// Route::resource('/permission', PermissionController::class);
Route::resource('permission','\App\Http\Controllers\admin\PermissionController');
Route::resource('feature',FeatureController::class);
Route::resource('category', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('attributes', AttributeController::class);
Route::resource('brands', BrandController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('blogs', BlogsController::class);
Route::resource('blogCat', BlogCategoryController::class);
Route::resource('filters', FilterController::class);
Route::resource('users', UserController::class);

Route::resource('roles', RoleController::class);
Route::resource('sliders', SliderController::class);
Route::post('slider.upate', [SliderController::class,'update'])->name('slider.update');
 Route::get('post.comment',[BlogsController::class,'Comments'])->name('post.comment');
  Route::get('blogs-comment-delete/{id}',[BlogsController::class,'postcommentdelete']);
Route::post('roles_update',[RoleController::class,'RolesUpdate'])->name('roles.role_update');
Route::get('assign_permission',[UserController::class,'assign_permission'])->name('AssigPermission.user');

Route::get('GetPermissions',[PermissionController::class,'GetPermissions'])->name('GetPermissions');
Route::post('assign_permissions',[PermissionController::class,'assignPermissions'])->name('AssignPermissions');
Route::get('de_Active/{id}',[PermissionController::class,'de_Active']);


Route::get('view_blog_desc/{id}',[BlogsController::class,'BlogDescription']);

Route::get('de_Active_role/{id}',[RoleController::class,'destroy']);
Route::get('check_slug',[ProductController::class,'getslug']);
Route::get('check_blog_slug',[BlogsController::class,'Getslug']);
Route::get('view_attributes_values/{id}',[AttributeController::class, 'ViewValues']);
Route::get('check_cat_slug',[CategoryController::class,'get_cat_slug']); 
Route::get('check_Blogcat_slug',[BlogCategoryController::class,'checkBlogcatslug']); 
Route::get('check_brand_slug',[BrandController::class,'get_brand_slug']);
Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');
    Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');
// Route::get('test_filter',[BrandController::class,'test_felter'])->name('test.filter');
// Route::post('filters',[BrandController::class,'filters']);
Route::post('ck/upload',[BlogsController::class,'ckUpload'])->name('ck.upload');
Route::post('ck_product/upload',[ProductController::class,'ckUploadProduct'])->name('ckProduct.upload');
Route::get('filter_value_delete/{id}',[FilterController::class,'delete_value']);
Route::get('Ads',[AdminController::class,'Ads'])->name('Ads.index');
Route::post('Ads.store',[AdminController::class,'AdsStore'])->name('Ads.store');
Route::post('Ads.update',[AdminController::class,'AdsUpdate'])->name('Ads.update');
Route::get('Ads.destroye/{id}',[AdminController::class,'AdsDelete'])->name('Ads.destroy');
// urrency 
Route::get('Currency',[AdminController::class,'Currency'])->name('Currency.index');
Route::post('Currency.store',[AdminController::class,'CurrencyStore'])->name('Currency.store');
Route::post('Currency.update',[AdminController::class,'CurrencyUpdate'])->name('Currency.update');
Route::get('Currency.destroye/{id}',[AdminController::class,'CurrencyDelete'])->name('Currency.destroy');
Route::get('comments',[AdminController::class,'ShowComment'])->name('Comments');
Route::get('comments_delete/{id}',[AdminController::class,'DeleteComment']);
Route::post('feature/update',[FeatureController::class,'update']);
Route::get('duplicate_product/{id}',[ProductController::class,'duplicate_product']);
Route::post('add_duplicate',[ProductController::class,'Duplicate_store']);
Route::get('getProductdetailbyid/{id}',[ProductController::class,'GetProductDetail']);
Route::post('productFeatures/store',[ProductController::class,'ProductFeaturesStore'])->name('StoreProductFeatures');
Route::post('productsGallery/store',[ProductController::class,'productsGalleryStore'])->name('productsGalleryStore');
Route::post('productsattributes/store',[ProductController::class,'productsattributes'])->name('productsattributes');
Route::post('productsFilters/store',[ProductController::class,'productsFiltersStore'])->name('productsFiltersStore');
Route::get('delete_attribute/{id}',[AttributeController::class,'AttibuteDelete']);
///////////////////////////////////////////////////
Route::get('products/galleyimage/delete/{id}',[ProductController::class,'destroy_images']);
Route::get('test',[AdminController::class,'test']);
// Route::get('product_view/{slug}',[AdminController::class,'testview']);

Route::get('update_password/{id}',[UserController::class,'updatepassword']);
Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Mail from test emails.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to('farhadkhanfarhad367@gmail.com')->send(new \App\Mail\MyTestMail($details));
   
    dd("Email is Sent.");
});
});

