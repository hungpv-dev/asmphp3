@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/nice-select.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/swiper.min.css')}}">
    <style>
        @keyframes quayTron {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        .non-forcus{
            pointer-events: none;
        }

        .fas.fa-circle-notch {
            animation: quayTron 1s linear infinite;
        }
    </style>
@endsection
@section('content')
    <div class="page-wrapper">
        <form method="POST" action="{{route('admin.products.store')}}" enctype="multipart/form-data" class="main-content">
            @csrf
            <!-- Page Title Start -->
            <div class="row">
                <div class="col xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-title-wrapper">
                        <div class="page-title-box">
                            <h4 class="page-title">Thêm sản phẩm</h4>
                        </div>
                        <div class="breadcrumb-list">
                            <ul>
                                <li class="breadcrumb-link">
                                    <a href="{{route('admin.home')}}"><i class="fas fa-home mr-2"></i>Trang chủ</a>
                                </li>
                                <li class="breadcrumb-link active">Thêm sản phẩm</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Products view Start -->
            <!--===Start Index2 Product single Section===-->
            <div class="int-product-single">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="int-thumb-slider">
                            <!-- Swiper -->
                            <div class="swiper-container gallery-top">
                                <div class="swiper-wrapper images-toggle">

                                </div>
                            </div>
                        </div>
                        <div class="int-minithumb-slider">
                            <div class="swiper-container gallery-thumbs">
                                <div class="swiper-wrapper images-slide">

                                </div>
                            </div>
                            <!-- Swiper -->
                        </div>
                        <div class="mt-3 int-minithumb-slider">
                            <div class="mb-3">
                                <input type="file" id="file-images" name="images[]" multiple style="width: 100%" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="int-thumb-sidebar">
                            <div class="int-price-detail row">
                                <h1><input type="text" name="name" class="product-name" value="{{old('name')}}" placeholder="Tên sản phẩm"></h1>
                                <p><input type="text" name="slug" value="{{old('slug')}}" placeholder="Slug" class="slug-name form-control" /></p>
                                <ul>
                                    <li><input type="text" name="price" value="{{old('price')}}" placeholder="Giá"></li>
                                </ul>
                                <p><input type="number" name="price_seal" placeholder="Giảm giá" value="{{old('price_seal') ?? 0}}" class="col-2" min="0" max="100" />%</p>
                            </div>
                            <div class="int-thumb-description">
                                <p>
                                    <textarea  name="desc_short" placeholder="Mô tả ngắn" style="width: 100%;height: 75px" id="description-short" cols="30" rows="10">
                                        {{old('desc_short')}}
                                    </textarea>
                                </p>
                                <ul>
                                    <li class=" border border-dark">
                                        <p>Màu: <input name="color" class="btn color p-1 btn-success min-vw-10" value="{{old('color') ?? 'Color'}}" ></p>
                                        <p>Cỡ: <input name="size" class="btn size p-1 btn-primary" value="{{old('size') ?? 'Size'}}" ></p>
                                        <p>Số lượng: <input name="count" class="btn count p-1 btn-warning" value="{{old('count') ?? 'Count'}}" ></p>
                                    </li>
                                </ul>
                            </div>
                            <div class="int-quantity-stock">
                                <ul>
                                    <li>
                                        <button class="btn ad-btn">Thêm sản phẩm</button>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="svg-icon">
                                            <svg viewBox="0 -28 512.001 512" xmlns="http://www.w3.org/2000/svg">
                                                <path d="m256 455.515625c-7.289062 0-14.316406-2.640625-19.792969-7.4375-20.683593-18.085937-40.625-35.082031-58.21875-50.074219l-.089843-.078125c-51.582032-43.957031-96.125-81.917969-127.117188-119.3125-34.644531-41.804687-50.78125-81.441406-50.78125-124.742187 0-42.070313 14.425781-80.882813 40.617188-109.292969 26.503906-28.746094 62.871093-44.578125 102.414062-44.578125 29.554688 0 56.621094 9.34375 80.445312 27.769531 12.023438 9.300781 22.921876 20.683594 32.523438 33.960938 9.605469-13.277344 20.5-24.660157 32.527344-33.960938 23.824218-18.425781 50.890625-27.769531 80.445312-27.769531 39.539063 0 75.910156 15.832031 102.414063 44.578125 26.191406 28.410156 40.613281 67.222656 40.613281 109.292969 0 43.300781-16.132812 82.9375-50.777344 124.738281-30.992187 37.398437-75.53125 75.355469-127.105468 119.308594-17.625 15.015625-37.597657 32.039062-58.328126 50.167969-5.472656 4.789062-12.503906 7.429687-19.789062 7.429687zm-112.96875-425.523437c-31.066406 0-59.605469 12.398437-80.367188 34.914062-21.070312 22.855469-32.675781 54.449219-32.675781 88.964844 0 36.417968 13.535157 68.988281 43.882813 105.605468 29.332031 35.394532 72.960937 72.574219 123.476562 115.625l.09375.078126c17.660156 15.050781 37.679688 32.113281 58.515625 50.332031 20.960938-18.253907 41.011719-35.34375 58.707031-50.417969 50.511719-43.050781 94.136719-80.222656 123.46875-115.617188 30.34375-36.617187 43.878907-69.1875 43.878907-105.605468 0-34.515625-11.605469-66.109375-32.675781-88.964844-20.757813-22.515625-49.300782-34.914062-80.363282-34.914062-22.757812 0-43.652344 7.234374-62.101562 21.5-16.441406 12.71875-27.894532 28.796874-34.609375 40.046874-3.453125 5.785157-9.53125 9.238282-16.261719 9.238282s-12.808594-3.453125-16.261719-9.238282c-6.710937-11.25-18.164062-27.328124-34.609375-40.046874-18.449218-14.265626-39.34375-21.5-62.097656-21.5zm0 0"/>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="svg-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300.095 300.095">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path d="M23.491,144.032c0-28.762,23.399-52.155,52.161-52.155h185.706l-46.874,46.874l14.31,14.305
																	l71.301-71.295L228.8,10.47L214.5,24.78l46.863,46.868H75.657c-39.912,0-72.389,32.477-72.389,72.389v7.419h20.228v-7.424H23.491
																	z"/>
                                                        </g>
                                                        <g>
                                                            <path d="M276.604,156.058c0,28.762-23.404,52.155-52.166,52.155H38.726l46.879-46.874L71.29,147.04
																	L0,218.335l71.295,71.29l14.299-14.31l-46.874-46.868h185.711c39.917,0,72.394-32.471,72.394-72.388v-7.419h-20.228v7.419
																	H276.604z"/>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--======End Index2 Product single Section======-->

            <!--===Products Details===-->
            <div class="product-detail-wrapper">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="product-detail-tab">
                            <ul class="nav nav-tabs">
                                <li><a data-bs-toggle="tab" class="active" href="#description">Mô tả</a></li>
                                <li><a data-bs-toggle="tab" href="#review">Review</a></li>
                                <li><a data-bs-toggle="tab" href="#info">Additional Information</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="description" class="tab-pane fade show active">
                                    <div class="int-tab-peragraph">
                                        <textarea name="desc" placeholder="Mô tả sản phẩm" style="width: 100%" id="description-content">
                                            {{old('desc')}}
                                        </textarea>
                                    </div>
                                </div>
                                <div id="review" class="tab-pane fade">
                                    <div class="fd-review-wrapper">
                                        <h3 class="review-heading">there are no reviews yet.</h3>
                                        <h5>be the first to review "this product"</h5>
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-block">
                                                            <input type="text" class="form_field" placeholder="First Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-block">
                                                            <input type="text" class="form_field" placeholder="Email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-block">
                                                            <textarea placeholder="Your Review" class="form_field"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <a href="javascript:;" class="ad-btn">Send</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="info" class="tab-pane fade">
                                    <ul class="additional-info">
                                        <li>
                                            <span class="info-head">size -</span>
                                            4 cm x 20 cm
                                        </li>
                                        <li>
                                            <span class="info-head">system rating -</span>
                                            high
                                        </li>
                                        <li>
                                            <span class="info-head">color -</span>
                                            brown
                                        </li>
                                        <li>
                                            <span class="info-head">material -</span>
                                            sofa
                                        </li>
                                        <li>
                                            <span class="info-head">model number -</span>
                                            GT 15014G
                                        </li>
                                        <li>
                                            <span class="info-head">generic name -</span>
                                            light
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--===Products Details===-->
            <div class="ad-footer-btm">
                <p>Copyright 2022 © SplashDash All Rights Reserved.</p>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        CKEDITOR.replace('description-content', options);
        CKEDITOR.replace('description-short', options);
    </script>
    <script>
        function formatSlug(value) {
            let lowercaseString = value.toLowerCase();
            let formattedString = lowercaseString.replace(/[^a-z0-9]+/g, '-');
            formattedString = formattedString.replace(/^-+|-+$/g, '');
            return formattedString;
        }

    //     Toggle Slug
        $(document).on('input','.product-name',function (){
            let value = formatSlug();
            $(".slug-name").val(value);
        });

    //     Toggle input images
        $(document).on('change','#file-images',function(event){
            let files = event.target.files;
            let contentToggle = '';
            let contentSlide = '';
            for(let i = 0 ;i < files.length; i ++){
                let file = files[i];
                if (file.type.match('image.*')) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        contentToggle += `
                            <div class="swiper-slide"><img src="${e.target.result}" alt="product-img"></div>
                        `;
                        contentSlide += `
                            <div class="swiper-slide position__relative">
                                <img src="${e.target.result}" alt="product-img">
                                <button type="button" class="btn p-0 delete-image position-absolute" style="z-index: 100;bottom: 5px;left:50%;transform: translateX(-50%);color: white">Xóa</button>
                            </div>
                        `;
                        $(".images-toggle").html(contentToggle);
                        $(".images-slide").html(contentSlide);
                    };
                    reader.readAsDataURL(file);
                }
            }

        });
    </script>
@endsection
