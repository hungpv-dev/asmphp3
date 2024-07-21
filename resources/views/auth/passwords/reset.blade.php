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
                            <h1 class="breadcrumb__content--title text-white mb-25">Đặt lại mật khẩu</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="{{route('home')}}">Trang chủ</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">Đặt lại mật khẩu</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End breadcrumb section -->

        <div class="header__search--widget header__sticky--none mt-5 d-flex justify-content-center">
            <form class=" header__search--form pb-2" method="POST" action="{{route('forget.reset')}}">
                @csrf
                <div class="header__search--box">
                    <label>
                        <input class="header__search--input" name="email" value="{{$email}}" placeholder="email" readonly type="text">
                    </label>
                </div>
                <div class="header__search--box">
                    <label>
                        <input class="header__search--input" name="password" value="{{old('password')}}" placeholder="Mật khẩu mới..." type="password">
                    </label>
                </div>
                <div class="header__search--box">
                    <label>
                        <input class="header__search--input" name="password_confirmation" value="{{old('password_confirmation')}}" placeholder="Nhập lại mật khẩu..." type="password">
                    </label>
                </div>

                <input type="hidden" name="token" value="">
                <div class="header__search--box d-flex justify-content-center">
                    <button class="btn fs-3 btn-primary">Đổi mật khẩu</button>
                </div>
            </form>
        </div>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="text-danger text-center">{{$error}}</p>
            @endforeach
        @endif
    </main>
@endsection


