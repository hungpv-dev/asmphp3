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
        <form method="POST" action="{{route('admin.products.update')}}" class="main-content">
            @method('PUT')
            @csrf
            <!-- Page Title Start -->
            <div class="row">
                <div class="col xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-title-wrapper">
                        <div class="page-title-box">
                            <h4 class="page-title">{{$product->name}}</h4>
                        </div>
                        <div class="breadcrumb-list">
                            <ul>
                                <li class="breadcrumb-link">
                                    <a href="{{route('admin.home')}}"><i class="fas fa-home mr-2"></i>Trang chủ</a>
                                </li>
                                <li class="breadcrumb-link active">{{$product->name}}</li>
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
                                    @foreach($product->images as $img)
                                        <div class="swiper-slide"><img src="{{$img->url}}" alt="product-img"></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="int-minithumb-slider">
                            <div class="swiper-container gallery-thumbs">
                                <div class="swiper-wrapper images-slide">
                                    @foreach($product->images as $img)
                                        <div class="swiper-slide position__relative">
                                            <img src="{{$img->url}}" alt="product-img">
                                            <button type="button" data-id="{{$img->id}}" class="btn p-0 delete-image position-absolute" style="z-index: 100;bottom: 5px;left:50%;transform: translateX(-50%);color: white">Xóa</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Swiper -->
                        </div>
                        <div class="mt-3 int-minithumb-slider">
                            <div class="mb-3">
                                <input type="file" id="file-images" multiple style="width: 100%" accept="image/*">
                                <button type="button" class="btn btn-add-images btn-primary">Thêm <i class="fas fa-cloud-upload-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="int-thumb-sidebar">
                            <div class="int-price-detail row">
                                <h1><input type="text" name="name" class="product-name" value="{{$product->name}}" /></h1>
                                <p><input type="text" name="slug" value="{{$product->slug}}" class="slug-name form-control" /></p>
                                <ul>
                                    <li><input type="text" name="price" value="{{$product->price}}" /></li>
                                    @if($product->price_seal > 0)
                                    <li>{{number_format($product->price - ($product->price_seal / 100 * $product->price))}}</li>
                                    <li>seal {{$product->price_seal}}%</li>
                                    @endif
                                </ul>
                                <p><input type="number" name="price_seal" class="col-2" min="0" max="100" value="{{$product->price_seal}}" />%</p>
                            </div>
                            <div class="int-thumb-description">
                                <p>
                                    <textarea  name="desc_short" style="width: 100%;height: 75px" id="description-short" cols="30" rows="10">
                                        {{$product->desc_short}}
                                    </textarea>
                                </p>
                                <ul id="listProperties">
                                    @foreach($product->properties as $property)
                                        <li><span>
                                                Màu: </span><button data-id="{{$property->id}}" type="button" contenteditable class="btn-color-property btn p-1 btn-success">{{$property->color}}</button>
                                            - <span>Cỡ: </span><button data-id="{{$property->id}}" type="button" contenteditable class="btn-size-property btn p-1 btn-primary">{{$property->size}}</button>
                                            - <span>Số lượng: </span><button data-id="{{$property->id}}" type="button" contenteditable class="btn-count-property btn p-1 btn-warning">{{$property->count}}</button>
                                            - <span>Trạng thái: </span><button data-id="{{$property->id}}" type="button" data-status="{{$property->status == 0 ? 1 : 0}}" class="btn-status-property btn p-1 btn-danger">{{$property->status == 0 ? 'Đang bán' : 'Ngưng bán'}} <i class="fas fa-sync-alt"></i></button>
                                            -> <span class="border delete-property rounded-circle" data-id="{{$property->id}}" style="cursor: pointer"><i class="icofont-close-line"></i></span>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul>
                                    <li class="form-add-property d-none border border-dark">
                                        <span>Màu: <button contenteditable class="btn color p-1 btn-success min-vw-10" type="button">Color</button></span>
                                        <span>Cỡ: <button contenteditable class="btn size p-1 btn-primary" type="button">Size</button></span>
                                        <span>Số lượng: <button contenteditable class="btn count p-1 btn-warning" type="button">Count</button></span>
                                    </li>
                                </ul>
                                <div class="d-flex">
                                    <button type="button" class="add-property btn btn-primary p-2">Thêm</button>
                                    <button type="button" class="close-property d-none btn btn-danger p-2">Hủy</button>
                                </div>
                            </div>
                            <div class="int-quantity-stock">
                                <ul>
                                    <li>
                                        <button class="btn ad-btn">Lưu chỉnh sửa</button>
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
                <input type="hidden" name="id" id="product_id" value="{{$product->id}}">
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
                                        <textarea name="desc" style="width: 100%" id="description-content">
                                            {{$product->desc}}
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

        let formAddProperty = $(".form-add-property");

        // Image
        $(document).on('click',".delete-image",function (){
            let id = $(this).data('id');
            let that = $(this);
            swal({
                title: "Chắc chắn?",
                text: "Bạn chắc chắn muốn xóa hình ảnh này chứ!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        deleteImage(that,id);
                    }
                });
        });

        // CreateImage
        $(document).on('click','.btn-add-images',function (){
           let files = $('#file-images')[0].files;
           let id = $("#product_id").val();
           let that = $(this);
           if(files.length === 0){
               swal('Thông báo','Vui lòng chọn file để tải!','warning');
           }else{
               createImages(files,id,that);
           }
        });

        function createImages(files,id,that){
            const formData = new FormData();
            formData.append('idProduct',id);
            for (let i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }
            $.ajax({
                url : "{{route('api.images.store')}}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function (){
                    that.html("<i class='fas fa-circle-notch'></i>");
                    that.addClass('non-forcus');
                },
                success: function (response){
                    $('#file-images').val('');
                    swal('Thông báo','Thêm hình ảnh thành công!','success');
                    that.html("Thêm <i class='fas fa-cloud-upload-alt'></i>");
                    that.removeClass('non-forcus');
                    let data = response.data;
                    let contentToggle = '';
                    let contentSlide = '';
                    data.forEach(function (item){
                        contentToggle += `
                            <div class="swiper-slide"><img src="${item.url}" alt="product-img"></div>
                        `;
                        contentSlide += `
                            <div class="swiper-slide position__relative">
                                <img src="${item.url}" alt="product-img">
                                <button type="button" data-id="${item.id}" class="btn p-0 delete-image position-absolute" style="z-index: 100;bottom: 5px;left:50%;transform: translateX(-50%);color: white">Xóa</button>
                            </div>
                        `;
                    });
                    $(".swiper-wrapper.images-toggle").append(contentToggle);
                    $(".swiper-wrapper.images-slide").append(contentSlide);
                },
                error: function (log){
                    console.log(log);
                }
            })
        }
        function deleteImage(that,id){
            $.ajax({
                url: "{{route('api.images.destroy',['id'])}}".replace('id',id),
                method: 'DELETE',
                success: function (response){
                    if(response.code == 200){
                        swal('Thông báo','Xóa hình ảnh thành công','success');
                        that.closest('.swiper-slide').remove();
                    }
                }
            })
        }



        // Properties
        $(document).on('click','.add-property',function(){
            if($(".form-add-property").hasClass('d-block')){
                let idProduct = $("#product_id").val();
                let color = $(".form-add-property .color").text();
                let size = $(".form-add-property .size").text();
                let count = $(".form-add-property .count").text();
                if(color.length < 1 || color.length > 30){
                    swal("Màu từ 1 - 30 kí tự!");
                }else if(size.length < 1 || size.length > 20){
                    swal("Cỡ từ 1 - 20 kí tự!");
                }else if(isNaN(count)){
                    swal("Số lượng phải là số!");
                }else{
                    createProperty(idProduct,color,size,count);
                }
            }
            showFormAddProperty();
        });
        $(document).on('click','.close-property',function(){
            showFormAddProperty(1);
        });
        $(document).on('click','.delete-property',function(){
           let id = $(this).data('id');
           let that = $(this);
            swal({
                title: "Chắc chắn?",
                text: "Bạn chắc chắn muốn xóa thuộc tính này chứ!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        deleteProperty(that,id);
                    }
                });
        });
        $(document).on('blur','.btn-color-property',function (){
           let that = $(this);
           let id = $(this).data('id');
           let text = $(this).text();
           let type = 'color';
           updateProperty(id,text,type,that);
        });
        $(document).on('blur','.btn-size-property',function (){
           let that = $(this);
           let id = $(this).data('id');
           let text = $(this).text();
           let type = 'size';
           updateProperty(id,text,type,that);
        });
        $(document).on('blur','.btn-count-property',function (){
            if(isNaN($(this).text())){
                swal("Số lượng phải là số!");
            }else{
               let that = $(this);
               let id = $(this).data('id');
               let text = $(this).text();
               let type = 'count';
               updateProperty(id,text,type,that);
            }
        });


        function createProperty(idProduct,color,size,count){
            $.ajax({
                url: "{{route('api.properties.store')}}",
                method: 'POST',
                data: {idProduct,color,size,count},
                success: function(response){
                    if(response.code == 201){
                        let data = response.data;
                        let content = `
                            <li><span>
                                    Màu: </span><button data-id="${data.id}" type="button" contenteditable class="btn-color-property btn p-1 btn-success">${data.color}</button>
                                - <span>Cỡ: </span><button data-id="${data.id}" type="button" contenteditable class="btn-size-property btn p-1 btn-primary">${data.size}</button>
                                - <span>Số lượng: </span><button data-id="${data.id}" type="button" contenteditable class="btn-count-property btn p-1 btn-warning">${data.count}</button>
                                - <span>Trạng thái: </span><button data-id="${data.id}" data-status="${data.status == 0 ? 1 : 0}" type="button" class="btn-status-property btn p-1 btn-danger">${data.status == 0 ? 'Đang bán' : 'Ngưng bán'} <i class="fas fa-sync-alt"></i></button>
                                -> <span class="border delete-property rounded-circle" data-id="${data.id}" style="cursor: pointer"><i class="icofont-close-line"></i></span>
                            </li>
                        `
                        $("#listProperties").append(content);
                        showFormAddProperty(1);
                        swal("Thành công!", "Thêm thuộc tính thành công!", "success");
                    }else{
                        swal("Thất bại!", "Thuộc tính này đã tồn tại!", "error");
                    }
                },
                error: function (log){
                    console.log(log);
                }
            })
        }
        // DeleteProperty
        function deleteProperty(that,id){
            $.ajax({
                url: "{{route('api.properties.destroy',['_id_'])}}".replace('_id_',id),
                method: 'DELETE',
                success: function (response) {
                    that.closest('li').remove();
                    swal("Thành công!", "Xóa thuộc tính thành công!", "success");
                }
            })
        }

        function updateProperty(id,text,type,that){
            $.ajax({
                url: "{{route('api.properties.update',['_id_'])}}".replace('_id_',id),
                method: 'PUT',
                data:{type,text},
                success: function (response){
                    let data = response.data;
                    if(that.hasClass('btn-status-property')){
                        if(data.status == 0){
                            that.data('status',1);
                            that.html('Đang bán <i class="fas fa-sync-alt"></i>');
                        }else{
                            that.data('status',0);
                            that.html('Ngừng bán <i class="fas fa-sync-alt"></i>');
                        }
                    }
                },
                error: function(log){
                    console.log(log);
                }
            });
        }

        // Toggle status property
        $(document).on('click','.btn-status-property',function(){
            let id = $(this).data('id');
            let that = $(this);
            let text = $(this).data('status');
            let type = 'status';
            swal({
                title: "Chắc chắn?",
                text: "Bạn chắc chắn muốn thay đổi chứ!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        updateProperty(id,text,type,that);
                    }
                });
        });

        // Show form add property
        function showFormAddProperty(status = 0){
            if(status == 0){
                $(".form-add-property").addClass('d-block');
                $(".form-add-property").removeClass('d-none');
                $(".close-property").addClass('d-block');
                $(".close-property").removeClass('d-none');
            }else{
                $(".form-add-property").addClass('d-none');
                $(".form-add-property").removeClass('d-block');
                $(".close-property").addClass('d-none');
                $(".close-property").removeClass('d-block');

                $(".form-add-property .color").text('color');
                $(".form-add-property .size").text('size');
                $(".form-add-property .count").text('count');
            }
        }
        function formatSlug(value) {
            let lowercaseString = value.toLowerCase();
            let formattedString = lowercaseString.replace(/[^a-z0-9]+/g, '-');
            formattedString = formattedString.replace(/^-+|-+$/g, '');
            return formattedString;
        }

    //     Toggle Slug
        $(document).on('input','.product-name',function (){
            let value = formatSlug($(this).val());
            $(".slug-name").val(value);
        });
    </script>
@endsection
