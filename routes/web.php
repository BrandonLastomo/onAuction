<?php

use App\Models\Item;
use App\Models\Auction;
use App\Models\Category;
use App\Models\AuctionHistory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardItemController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterStaffController;

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

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'store']);


Route::middleware(['role:citizen', 'auth'])->group(function(){
    Route::get('/mybid', [HomeController::class, 'mybid']);
    Route::get('/{item:slug}/bidStore', [AuctionController::class, 'bidStore']);
});

Route::middleware(['role:admin,staff', 'auth'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('/dashboard/staff', RegisterStaffController::class);
    Route::resource('/dashboard/items', DashboardItemController::class);
    Route::get('/dashboard/items/{item:slug}/openAuction', [AuctionController::class, 'openAuction']);
    Route::get('/dashboard/closeAuction', [AuctionController::class, 'closeAuction']);
    Route::resource('/dashboard/categories', DashboardCategoryController::class);
    Route::get('/dashboard/{item:slug}', [DashboardController::class, 'show']);
    Route::get('/{item:slug}/generate-report', [HomeController::class, 'generateReport']);
    Route::get('/dashboard/{item:slug}/deleteAuction', [AuctionController::class, 'deleteAuction']);
});

Route::get('/', [HomeController::class, "index"]);
Route::get('/categories', [CategoryController::class, "index"]);
Route::get('/categories/{category:slug}', [CategoryController::class, "categoryItems"]);
Route::get('/{item:slug}', [AuctionController::class, 'autoCloseAuction']);
Route::get('/{item:slug}', [HomeController::class, 'show'])->name('item_detail');

