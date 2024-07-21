@extends('layouts.app')

@section('title')
    {{$title}}
@endsection
@section('content')
    <main class="main__content_wrapper">

        <!-- Start breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title text-white mb-25">Tài khoản</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="{{route('home')}}">Trang chủ</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">Đăng kí</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End breadcrumb section -->

        <!-- Start login section  -->
        <div class="login__section section--padding">
            <div class="container">
                <div action="">
                    <div class="login__section--inner">
                        <div class="row row-cols-md-2 row-cols-1">
                            <form class="col m-auto" method="POST" action="">
                                @csrf
                                <div class="account__login register">
                                    <div class="account__login--header mb-25">
                                        <h2 class="account__login--header__title h3 mb-10">Tạo tài khoản</h2>
                                        <p class="account__login--header__desc">Đăng kí ở đây nếu bạn muốn có một tài khoản mới!</p>
                                    </div>
                                    <div class="account__login--inner">
                                        <input class="account__login--input" name="name" value="{{old('name')}}" placeholder="Họ và tên" type="text">
                                        @error('name')
                                        <p class="text-danger m-0">{{$message}}</p>
                                        @enderror
                                        <input class="account__login--input" name="email" value="{{old('email')}}" placeholder="Email..." type="text">
                                        @error('email')
                                        <p class="text-danger m-0">{{$message}}</p>
                                        @enderror
                                        <input class="account__login--input" name="password" value="{{old('password')}}" placeholder="Mật khẩu" type="password">
                                        @error('password')
                                        <p class="text-danger m-0">{{$message}}</p>
                                        @enderror
                                        <input class="account__login--input" name="password_confirmation" value="{{old('password_confirmation')}}" placeholder="Nhập lại mật khẩu" type="password">
                                        @error('password_confirmation')
                                        <p class="text-danger m-0">{{$message}}</p>
                                        @enderror
                                        <button class="account__login--btn primary__btn mb-10 mt-3" type="submit">Xác nhận đăng kí</button>
                                        <div class="account__login--remember position__relative">
                                            <input class="checkout__checkbox--input" name="checked" id="check2" type="checkbox">
                                            <span class="checkout__checkbox--checkmark"></span>
                                            <label class="checkout__checkbox--label login__remember--label" for="check2">
                                                Tôi đã đọc điều khoản dịch vụ & chính sách bảo mật</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End login section  -->

        <!-- Start shipping section -->
        <section class="shipping__section2 shipping__style3 section--padding pt-0">
            <div class="container">
                <div class="shipping__section2--inner shipping__style3--inner d-flex justify-content-between">
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img src="assets/img/other/shipping1.png" alt="">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Shipping</h2>
                            <p class="shipping__items2--content__desc">From handpicked sellers</p>
                        </div>
                    </div>
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img src="assets/img/other/shipping2.png" alt="">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Payment</h2>
                            <p class="shipping__items2--content__desc">From handpicked sellers</p>
                        </div>
                    </div>
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img src="assets/img/other/shipping3.png" alt="">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Return</h2>
                            <p class="shipping__items2--content__desc">From handpicked sellers</p>
                        </div>
                    </div>
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img src="assets/img/other/shipping4.png" alt="">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Support</h2>
                            <p class="shipping__items2--content__desc">From handpicked sellers</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End shipping section -->

    </main>
@endsection
