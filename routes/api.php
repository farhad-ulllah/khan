<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Public routes
//session route
Route::middleware('api-session')->post('change_currency_rate',[AdminController::class,'ChangeCurrency']);

// Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/popular', [ProductController::class, 'popular']);
Route::get('/trending', [ProductController::class, 'trending']);
Route::get('/upcoming', [ProductController::class, 'upcoming']);
Route::get('product/{slug}',[ProductController::class,'ProductView']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/brands', [CategoryController::class, 'AllBrands']);
Route::get('/get_products', [ProductController::class, 'get_products']);
Route::post('/phone_finder', [ApiController::class, 'phone_finder']);
Route::get('/get_blogs', [ApiController::class, 'get_blogs']);
Route::get('/max_blogs', [ApiController::class, 'maxCount']);
Route::get('/filters_products', [ApiController::class, 'filters_products']);
Route::get('/brands/product/{slug}', [CategoryController::class, 'BrandsProducts']);
Route::get('/blog/{slug}', [ApiController::class, 'Singleblogs']);
Route::get('category/product/{slug}', [CategoryController::class, 'show_products']);
Route::get('/product/search/{name}', [ProductController::class, 'search']);
Route::get('/compare_this/{slug}', [ProductController::class, 'CompareThisProducts']);
Route::get('/compare_to/{slug}', [ProductController::class, 'CompareToProducts']);
Route::get('/slides', [ApiController::class, 'slider']);
Route::get('/filters', [ApiController::class, 'filters']);
Route::post('/product_price_finder', [ProductController::class, 'price_finder']);
Route::get('/ram_products/{ram}', [ProductController::class, 'RamProducts']);
Route::get('/currency', [ApiController::class, 'currency']);
Route::get('/currency_price/{id}', [ApiController::class, 'currency_price']);
Route::post('/newslatter/store', [ApiController::class, 'NewsLatterStore']);
Route::post('/reviews/store', [ReviewController::class, 'ReviewStore']);
Route::get('/features', [ProductController::class, 'features']);
Route::get('/groups', [ProductController::class, 'groups']);
Route::get('/compare/{one}/{two}', [ProductController::class, 'Compares']);
Route::get('/mulitple_products', [ProductController::class, 'mulitple']);
Route::get('/browse_budget/{price}', [ProductController::class, 'BrowseBudgetProducts']);
//Notificatons
Route::get('/notifications', [ApiController::class, 'Notifications']);
//SEarch Lists
Route::get('/search_lists', [ApiController::class, 'Searchlist']);
// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('comments_save',[AdminController::class,'CommentsSave'])->name('comments.store');
     Route::post('blogcommentsave',[ReviewController::class,'bogCommentsSave']);
     Route::post('save-likedislike',[ProductController::class,'save_likedislike']);
     Route::post('blogsave-likedislike',[ReviewController::class,'blogsave_likedislike']);
});


Route::get('ads',[ApiController::class,'Ads']);
Route::get('roles',[ApiController::class,'roles']);
Route::post('register',[AuthController::class,'user_register']);
Route::post('send_message',[ApiController::class,'send_message']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});
Route::get('sitemap', [ApiController::class, 'generate']);
