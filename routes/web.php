<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{
    LoginController,
    RegisterController,
    VerifyController,
    ForgetController,
    FacebookController,
    GoogleController,
    TwitterController,
};
use App\Http\Controllers\{
    HomeController,
    AccountController,
    ProductController,
    CartController,
    CommentController,
    OrderController,
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('test',function(){
    broadcast(new \App\Events\OrderNotify('Chúc bạn may mắn'));
    echo 'Đã gửi';
});

// Demo
Route::view('demo','demo');


// Đăng nhập
Route::get('dang-nhap',[LoginController::class,'showFormLogin'])->name('login');
Route::post('dang-nhap',[LoginController::class,'login'])->name('login');

//Mạng xã hội
Route::get('facebook',[FacebookController::class,'redirectTo'])->name('facebook');
Route::get('/facebook/callback', [FacebookController::class,'callback']);

Route::get('google',[GoogleController::class,'redirectTo'])->name('google');
Route::get('/google/callback', [GoogleController::class,'callback']);

Route::get('twitter',[TwitterController::class,'redirectTo'])->name('twitter');
Route::get('/twitter/callback', [TwitterController::class,'callback']);

// Đăng kí
Route::get('dang-ki',[RegisterController::class,'showFormRegister'])->name('register');
Route::post('dang-ki',[RegisterController::class,'register'])->name('register');

// Đăng xuất
Route::match(['post','get'],'dang-xuat',[LoginController::class,'logout'])->name('logout');

// Xác thực
Route::get('xac-thuc',[VerifyController::class,'showFormVerify'])->name('verify.show');
Route::post('xac-thuc',[VerifyController::class,'verifySendMail'])->name('verify.send');
Route::get('xac-thuc/{hash}/{email}',[VerifyController::class,'verify'])->name('verify');

// Quên mật khẩu
Route::get('quen-mat-khau',[ForgetController::class,'showFormForget'])->name('forget');
Route::post('quen-mat-khau',[ForgetController::class,'forgetSendMail'])->name('forget.send');
Route::get('quen-mat-khau/{email}/{token}',[ForgetController::class,'forget'])->name('forget.verify');
Route::post('dat-lai-mat-khau',[ForgetController::class,'resetPassword'])->name('forget.reset');

// Trang chủ
Route::get('/', [HomeController::class,'index'])->name('home');

// Cửa hàng
Route::prefix('san-pham')->name('product.')->group(function(){
    Route::get('/',[ProductController::class,'index'])->name('show');
    Route::get('/{slug}-{id}',[ProductController::class,'detail'])->name('detail')->where([
        'slug' => '.*',
        'id' => '[0-9]+'
    ]);
});

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::middleware('auth')->group(function(){
    Route::get('remember',[LoginController::class,'rememberToken']);

    Route::prefix('tai-khoan')->name('account.')->group(function () {
        Route::get('/',[AccountController::class,'index'])->name('show');
        Route::get('dia-chi',[AccountController::class,'address'])->name('address');
        Route::post('dia-chi',[AccountController::class,'updateAddress'])->name('address');
    });

    Route::prefix('gio-hang')->name('cart.')->group(function (){
       Route::get('/',[CartController::class,'index'])->name('show');
       Route::post('/',[CartController::class,'add'])->name('add');
       Route::put('/{id}',[CartController::class,'updateCartId'])->name('update');
       Route::delete('/xoa-gio-hang/{id}',[CartController::class,'destroy'])->name('destroy');
       Route::get('/xoa-gio-hang',[CartController::class,'clear'])->name('clear');
    });

    Route::prefix('mua-hang')->name('order.')->group(function(){
        Route::get('/',[OrderController::class,'info'])->name('info');
        Route::post('/',[OrderController::class,'saveInfo'])->name('info');
        Route::post('/order',[OrderController::class,'saveOrder'])->name('save');
        Route::get('/order',[OrderController::class,'infoOrder'])->name('save');
        Route::get('thong-tin/{id}',[OrderController::class,'show'])->name('show');
    });

    Route::resource('binh-luan',CommentController::class)->names('comment');
});



