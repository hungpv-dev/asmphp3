<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\{
    ForgetController,
    LoginController,
    VerifyController
};

use App\Http\Controllers\Admin\{
    ProfileController,
    DashboardController,
    CategoryController,
    ProductController,
    FeeShipController,
    GiftCodeController,
    OrderController,
};


Route::get('register/{tk}/{mk}', [LoginController::class, 'register']);

Route::get('login', [LoginController::class, 'showFormLogin'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('forget',[ForgetController::class,'showFormSendMail'])->name('forget');
Route::post('forget',[ForgetController::class,'forget'])->name('forget');
Route::get('verify/{email}/{token}',[VerifyController::class,'verify'])->name('verify');
Route::put('reset',[VerifyController::class,'reset'])->name('reset');

Route::middleware('admin.auth')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class,'index'])->name('home');
    Route::get('/user',[DashboardController::class,'user'])->name('user');

    // Profile
    Route::get('trang-ca-nhan', [ProfileController::class,'index'])->name('profile');
    Route::post('trang-ca-nhan', [ProfileController::class,'profile'])->name('profile');
    Route::put('trang-ca-nhan', [ProfileController::class,'changePassword'])->name('profile');

    // Categories
    Route::prefix('danh-muc')->name('categories.')->group(function(){
        Route::get('/',[CategoryController::class,'index'])->name('home');
        Route::get('list/{id}',[CategoryController::class,'list'])->name('list');
    });

    // Product
    Route::prefix('san-pham')->name('products.')->group(function(){
       Route::get('/',[ProductController::class,'index'])->name('home');
       Route::get('/{slug}-{id}',[ProductController::class,'show'])->name('show')->where([
           'slug' => '.*',
           'id' => '[0-9]+'
       ]);
       Route::put('cap-nhat',[ProductController::class,'update'])->name('update');
       Route::get('them-san-pham',[ProductController::class,'create'])->name('create');
       Route::post('them-san-pham',[ProductController::class,'store'])->name('store');
       Route::get('danh-muc-san-pham/{id}',[ProductController::class,'categories'])->name('categories');
       Route::post('danh-muc-san-pham',[ProductController::class,'storeCategories'])->name('store.categories');
    });

    // FeeShip
    Route::prefix('phi-van-chuyen')->name('feeship.')->group(function(){
       Route::get('/',[FeeShipController::class,'index'])->name('home');
    });

    // GiftCode
    Route::resource('ma-giam-gia',GiftCodeController::class)->names('giftcode');

    // Order
    Route::prefix('don-hang')->name('order.')->group(function(){
        Route::get('/',[OrderController::class,'index'])->name('home');
        Route::get('/{id}',[OrderController::class,'detail'])->name('detail');
        Route::put('/{id}',[OrderController::class,'update'])->name('update');
    });
});
