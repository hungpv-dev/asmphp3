@extends('layouts.app')

@section('title')
    {{$title}}
@endsection
@section('content')
    <main class="main__content_wrapper pb-5">
        <!-- Start breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title text-white mb-25">Quên mật khẩu</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="{{route('home')}}">Trang chủ</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">Quên mật khẩu</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End breadcrumb section -->

        <div class="header__search--widget header__sticky--none mt-5 d-flex justify-content-center">
            <form class="d-flex header__search--form" method="POST" action="{{route('forget.send')}}">
                @csrf
                <div class="header__search--box">
                    <label>
                        <input class="header__search--input" name="email" placeholder="Email của bạn..." type="text">
                    </label>
                    <button class="header__search--button bg__secondary text-white" type="submit" aria-label="search button">
                        <svg class="header__search--button__svg" xmlns="http://www.w3.org/2000/svg" width="27.51" height="26.443" viewBox="0 0 512 512"><path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path></svg>
                    </button>
                </div>
            </form>
        </div>
        @error('email')
        <p class="text-center text-danger">{{$message}}</p>
        @enderror
    </main>
@endsection


