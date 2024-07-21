<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\API\VietNam\{
    DistrictsController,
    ProvincesController,
    WardsController
};
use App\Http\Controllers\API\{
    CategoryController,
    ProductController,
    PropertyController,
    ImageController,
    FeeShipController,
    GiftCodeController,
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('vietnam')->name('api.vietnam.')->group(function(){
    Route::get('provinces',[ProvincesController::class,'index'])->name('provinces');
    Route::get('provinces/{code}',[ProvincesController::class,'getProvinces'])->name('provinces');
    Route::get('districts/{code}',[DistrictsController::class,'index'])->name('district');
    Route::get('wards/{code}',[WardsController::class,'index'])->name('wards');
});

Route::apiResource('categories',CategoryController::class)->names('api.categories');
Route::apiResource('products',ProductController::class)->names('api.products');
Route::apiResource('properties',PropertyController::class)->names('api.properties');
Route::apiResource('images',ImageController::class)->names('api.images');
Route::apiResource('feeships',FeeShipController::class)->names('api.feeships');
Route::apiResource('giftcodes',GiftCodeController::class)->names('api.giftcodes');

