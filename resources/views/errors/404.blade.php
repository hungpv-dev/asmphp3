@extends('layouts.app')
@section('title')
    404 | Suruchi
@endsection
@section('content')
    <main class="main__content_wrapper">

        <!-- Start breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title text-white mb-25">Error 404</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="{{route('home')}}">Trang chủ</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">Error 404</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End breadcrumb section -->

        <!-- Start error section -->
        <section class="error__section section--padding">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="error__content text-center">
                            <img class="error__content--img mb-50" src="{{asset('assets/img/other/404-thumb.png')}}" alt="error-img">
                            <h2 class="error__content--title">Opps ! We,ar Not Found This Page </h2>
                            <p class="error__content--desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi animi aliquid minima assumenda.</p>
                            <a class="error__content--btn primary__btn" href="{{route('home')}}">Back To Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End error section -->

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
