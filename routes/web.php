<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LinkController;

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

Route::get('/', function () {
    return redirect('category');
});
//Post
Route::get('post', [PostController::class,'index']);
Route::post('post_crawl', [PostController::class,'post_crawl']);
Route::get('post_crawl/{id}', [PostController::class,'post_crawlById']);
Route::get('post_detail/{id}', [PostController::class,'post_detail']);


//Category
Route::resource('category', CategoryController::class);
Route::get('category_update', [CategoryController::class,'category_update']);

//Link
Route::get('link', [LinkController::class,'index']);
Route::post('link_crawl', [LinkController::class,'link_crawl']);

