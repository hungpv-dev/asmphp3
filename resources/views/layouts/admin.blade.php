<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zxx">
<!--<![endif]-->
<!-- Begin Head -->


<!-- Mirrored from kamleshyadav.com/html/splashdash/html/b5/light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Feb 2024 06:44:21 GMT -->
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="MobileOptimized" content="320">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/fonts.css')}}">
    @vite(['resources/sass/app.scss'])
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/icofont.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/style.css')}}">
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/admin/images/favicon.png')}}">
    <title>@yield('title')</title>
    @yield('style')
</head>

<body>
@include('sweetalert::alert')

<div class="loader">
    <div class="spinner">
        <img src="{{asset('assets/admin/images/loader.gif')}}" alt=""/>
    </div>
</div>

<!-- Main Body -->
<div class="page-wrapper">
    <!-- Header Start -->
    <header class="header-wrapper main-header">
        <div class="header-inner-wrapper">
            <div class="header-right">
                <div class="serch-wrapper">
                    <form>
                        <input type="text" placeholder="Tìm kiếm ở đây...">
                    </form>
                    <a class="search-close" href="javascript:void(0);"><span class="icofont-close-line"></span></a>
                </div>
                <div class="header-left">
                    <div class="header-links">
                        <a href="javascript:void(0);" class="toggle-btn">
                            <span></span>
                        </a>
                    </div>
                    <div class="header-links search-link">
                        <a class="search-toggle" href="javascript:void(0);">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve">
                                    <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23
                                    s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92
                                    c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17
                                    s-17-7.626-17-17S14.61,6,23.984,6z"/>
                                </svg>
                        </a>
                    </div>
                </div>
                <div class="header-controls">
                   
                    <div class="user-info-wrapper header-links">
                        <a href="javascript:void(0);" class="user-info">
                            <img src="{{asset('assets/admin/images/user.jpg')}}" alt="" class="user-img">
                            <div class="blink-animation">
                                <span class="blink-circle"></span>
                                <span class="main-circle"></span>
                            </div>
                        </a>
                        <div class="user-info-box">
                            <div class="drop-down-header">
                                <h4>{{auth('admin')->user()->name}}</h4>
                                <p>Developer</p>
                            </div>
                            <ul>
                                <li>
                                    <a href="{{route('admin.profile')}}">
                                        <i class="far fa-edit"></i> Cập nhật
                                    </a>
                                </li>
                                <li>
                                    <form action="{{route('admin.logout')}}" method="POST">
                                        @csrf
                                    <button class="btn p-0">
                                        <i class="fas fa-sign-out-alt"></i> logout
                                    </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Sidebar Start -->
    <aside class="sidebar-wrapper">
        <div class="logo-wrapper">
            <a href="{{route('home')}}" class="admin-logo">
                <img src="{{asset('assets/admin/images/logo.png')}}" alt="" class="sp_logo">
                <img src="{{asset('assets/admin/images/mini_logo.png')}}" alt="" class="sp_mini_logo">
            </a>
        </div>
        <div class="side-menu-wrap">
            <ul class="main-menu">
                <li>
                    <a href="javascript:void(0);" class="active">
                            <span class="icon-menu feather-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            </span>
                        <span class="menu-text">
                                Trang chủ
                            </span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{route('admin.home')}}">
                                    <span class="icon-dash">
                                    </span>
                                <span class="menu-text">
                                        Admin
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.user')}}">
                                    <span class="icon-dash">
                                    </span>
                                <span class="menu-text">
                                        User
                                    </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('admin.categories.home')}}">
                            <span class="icon-menu feather-icon">
                                <i class="fas fa-layer-group"></i>
                            </span>
                        <span class="menu-text">
                                Danh mục
                            </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.products.home')}}">
                            <span class="icon-menu feather-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                            </span>
                        <span class="menu-text">
                                Sản phẩm
                            </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.order.home')}}">
                            <span class="icon-menu feather-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                            </span>
                        <span class="menu-text">
                                Đơn hàng
                            </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.feeship.home')}}">
                            <span class="icon-menu feather-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                            </span>
                        <span class="menu-text">
                                Phí vận chuyển
                            </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.giftcode.index')}}">
                        <span class="icon-menu feather-icon">
                            <i class="fas fa-gift"></i>
                        </span>
                        <span class="menu-text">
                                Mã giảm giá
                            </span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    @yield('content');
</div>



<!-- Script Start -->
<script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/js/popper.min.js')}}"></script>
@vite(['resources/js/app.js'])

<script src="{{asset('assets/admin/js/swiper.min.js')}}"></script>
<!-- Page Specific -->
<script src="{{asset('assets/admin/js/nice-select.min.js')}}"></script>
<!-- Custom Script -->
<script src="{{asset('assets/admin/js/custom.js')}}"></script>
<script src="{{asset('assets/js/function.js')}}"></script>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>
@yield('script')
</body>


<!-- Mirrored from kamleshyadav.com/html/splashdash/html/b5/light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Feb 2024 06:44:22 GMT -->
</html>
