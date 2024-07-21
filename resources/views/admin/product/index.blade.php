@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/range.css')}}">
    <style>
        #categories{
            max-height: 400px;
            overflow: hidden;
            overflow-y:auto ;
        }
    </style>
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="main-content">
            <!-- Page Title Start -->
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-title-wrapper">
                        <div class="page-title-box">
                            <h4 class="page-title">Danh sách sản phẩm</h4>
                        </div>
                        <div class="breadcrumb-list">
                            <ul>
                                <li class="breadcrumb-link">
                                    <a href="{{route('admin.home')}}"><i class="fas fa-home mr-2"></i>Trang chủ</a>
                                </li>
                                <li class="breadcrumb-link active">Danh sách sản phẩm</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="add-group d-flex justify-content-end mb-2">
                <a href="{{route('admin.products.create')}}" class="ad-btn add-btn-category">Thêm sản phẩm</a>
            </div>
            <!-- Table Start -->
            <div class="row ad-btm-space">
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12">
                    <div class="int-blog-sidebar">
                        <div class="int-sidebar-box">
                            <h4>search</h4>
                            <form id="form-search" class="int-search-btn">
                                <div class="input-group">
                                    <input type="text" id="input-search" placeholder="Tìm kiếm...">
                                    <div class="input-group-append">
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30.239 30.239" width="18" height="18"><g><g>
                                                        <path d="M20.194,3.46c-4.613-4.613-12.121-4.613-16.734,0c-4.612,4.614-4.612,12.121,0,16.735   c4.108,4.107,10.506,4.547,15.116,1.34c0.097,0.459,0.319,0.897,0.676,1.254l6.718,6.718c0.979,0.977,2.561,0.977,3.535,0   c0.978-0.978,0.978-2.56,0-3.535l-6.718-6.72c-0.355-0.354-0.794-0.577-1.253-0.674C24.743,13.967,24.303,7.57,20.194,3.46z    M18.073,18.074c-3.444,3.444-9.049,3.444-12.492,0c-3.442-3.444-3.442-9.048,0-12.492c3.443-3.443,9.048-3.443,12.492,0   C21.517,9.026,21.517,14.63,18.073,18.074z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#ffffff"></path></g></g>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="int-sidebar-box recent-blog-one">
                            <h4>Danh mục</h4>
                            <div class="int-blog-category-mini">
                                <ul id="categories">
                                    @foreach($categories as $category)
                                        <li class="pe-2">
                                            <button data-id="{{$category->id}}" class="btn-category btn p-0">
                                                <svg width="12px" height="8px">
                                                    <path fill-rule="evenodd"  fill="{{$category->status != 0 ? 'red' : ''}}" d="M0.038,4.720 L6.164,4.710 C6.558,4.710 6.878,4.392 6.878,3.999 L6.878,2.016 L9.967,3.999 L5.777,6.688 C5.445,6.901 5.349,7.342 5.563,7.673 C5.777,8.004 6.219,8.099 6.551,7.886 L11.673,4.597 C11.877,4.466 12.000,4.241 12.000,3.999 C12.000,3.756 11.877,3.531 11.673,3.400 L6.551,0.112 C6.331,-0.030 6.051,-0.040 5.822,0.085 C5.592,0.210 5.449,0.449 5.449,0.710 L5.449,3.286 L0.000,3.286 "/>
                                                </svg> {{$category->name}}
                                            </button>
                                            @php
                                            $count = 0;
                                            $category->countProducts($category->id,$count)
                                            @endphp
                                            <span>{{$count}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="int-sidebar-box">
                            <h4>Trạng thái</h4>
                            <div class="int-blog-category-mini">
                                <div class="d-flex align-items-center">
                                    <input class="status-products p-0 m-0" value="0" id="dangban" type="checkbox">
                                    <label class="p-0 m-0 ms-2" for="dangban">Đang bán</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input class="status-products p-0 m-0" value="1" id="ngungban" type="checkbox">
                                    <label class="p-0 m-0 ms-2" for="ngungban">Ngưng bán</label>
                                </div>
                            </div>
                        </div>
                        <div class="int-sidebar-box">
                            <h4>Giảm giá</h4>
                            <div class="int-blog-category-mini">
                                <ul>
                                    <li>
                                        <div class="int-checkbox">
                                            <input type="checkbox" class="seals" id="auth_remember2" name="remember" value="10">
                                            <label for="auth_remember2">Trên 10%</label>
                                        </div>
                                        </li>
                                    <li>
                                        <div class="int-checkbox">
                                            <input type="checkbox" class="seals" id="auth_remember21" name="remember" value="20">
                                            <label for="auth_remember21">Trên 20%</label>
                                        </div>
                                        </li>
                                    <li>
                                        <div class="int-checkbox">
                                            <input type="checkbox" class="seals" id="auth_remember3" name="remember" value="30">
                                            <label for="auth_remember3">Trên 30%</label>
                                        </div>
                                        </li>
                                    <li>
                                        <div class="int-checkbox">
                                            <input type="checkbox" class="seals" id="auth_remember4" name="remember" value="50">
                                            <label for="auth_remember4">Trên 50%</label>
                                        </div>
                                        </li>
                                    <li>
                                        <div class="int-checkbox">
                                            <input type="checkbox" class="seals" id="auth_remember5" name="remember" value="70">
                                            <label for="auth_remember5">Trên 70%</label>
                                        </div>
                                        </li>
                                    <li>
                                        <div class="int-checkbox">
                                            <input type="checkbox" class="seals" id="auth_remember6" name="remember" value="80">
                                            <label for="auth_remember6">Trên 80%</label>
                                        </div>
                                        </li>
                                    <li>
                                        <div class="int-checkbox">
                                            <input type="checkbox" class="seals" id="auth_remember7" name="remember" value="85">
                                            <label for="auth_remember7">Trên 85%</label>
                                        </div>
                                        </li>
                                    <li>
                                        <div class="int-checkbox">
                                            <input type="checkbox" class="seals" id="auth_remember8" name="remember" value="95">
                                            <label for="auth_remember8">Trên 95%</label>
                                        </div>
                                        </li>
                                </ul>
                            </div>
                        </div>
                        <div class="int-sidebar-box recent-blog-one">
                            <img src="{{asset('assets/admin/images/thumb1.png')}}" class="img-fluid" alt="Image"/>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12">
                    <div class="main-product-grid">
                        <div id="change-products" class="d-flex flex-wrap"></div>
                        <ul id="products">
                            @foreach($products as $product)
                            <li>
                                <div class="product-grid">
                                    <div class="product-item">
                                        <img src="{{optional($product->images->first())->url}}" alt="product-img"/>
                                        @if($product->price_seal > 0)
                                            <div class="product-overlay"><h4>-{{$product->price_seal}} %</h4></div>
                                        @endif
                                        <div class="product-ovr-links">
                                            <ul class="d-flex align-items-center justify-content-evenly">
                                                <li style="min-width: 50px">
                                                    <a href="{{route('admin.products.show',[$product->slug,$product->id])}}" class="btn p-0 fs-5 fw-normal text-white">
                                                        <i class="fas fa-box-open"></i>
                                                    </a>
                                                </li>
                                                <li style="min-width: 50px">
                                                    <a href="{{route('admin.products.categories',[$product->id])}}" class="btn p-0 fs-5 fw-normal text-white">
                                                        <i class="fas fa-layer-group"></i>
                                                    </a>
                                                </li>
                                                <li style="min-width: 50px">
                                                    <button data-id="{{$product->id}}" data-status="{{$product->status == 0 ? 1 : 0}}" class="btn-change-status btn p-0 fs-4 fw-normal text-white">
                                                        @if($product->status == 0 )
                                                        <i class="fas fa-toggle-on"></i>
                                                        @else
                                                        <i class="fas fa-toggle-off"></i>
                                                        @endif
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-text-rs">
                                        <a href="javascript:;">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="fals"></i>
                                            <i class="fa fa-star" aria-hidden="fals"></i>
                                        </a>
                                        <small class="status-notify text-danger fw-bold">
                                            {{$product->status != 0 ? '    (Ngừng bán)' : ''}}
                                        </small>
                                        <h3><a href="{{route('admin.products.show',[$product->slug,$product->id])}}">{{$product->name}}</a></h3>
                                        <h6>{!! Str::limit($product->desc_short, 30) !!}</h6>
                                        @if($product->price_seal > 0)
                                        <p><span>{{number_format($product->price)}} </span>{{number_format($product->price - ($product->price_seal / 100 * $product->price))}}</p>
                                        @else
                                        <p>{{number_format($product->price)}}</p>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="ad-footer-btm">
                <p>Copyright 2022 © SplashDash All Rights Reserved.</p>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('assets/admin/js/range.js')}}"></script>
    <script>
        function getCategories(id){
            $.ajax({
                url: "{{route('admin.categories.list',['__id__'])}}".replace('__id__',id),
                method: 'GET',
                success: function (response){
                    let data = response.data;
                    let parent = response.parent;
                    $("#change-products .close-change-cate").remove();
                    let content = data.map(function(item,index){
                        if(!parent){
                            index++;
                        }else{
                            if(index==0){
                                let changeProducts = `
                                <button data-content="${parent}" class="me-2 close-change-cate d-block d-flex bg-white align-items-center justify-content-between py-2 border px-3">
                                    <span>Danh mục: ${item.name}</span>
                                    <i class="ms-2 fs-5 pt-1 icofont-close-line"></i>
                                </button>
                                `;
                                $("#change-products").append(changeProducts);
                            }
                        }
                        return `
                            <li class="${index==0?'border rounded':''} pe-2">
                                <button data-id="${index==0?item.parent_id:item.id}" class="${index==0?'btn-back-category':'btn-category'} btn p-0">
                                    <svg style="${index==0?'transform: rotate(180deg);':''}" width="12px" height="8px">
                                        <path fill-rule="evenodd"  fill="${item.status != 0 ? 'red' : ''}" d="M0.038,4.720 L6.164,4.710 C6.558,4.710 6.878,4.392 6.878,3.999 L6.878,2.016 L9.967,3.999 L5.777,6.688 C5.445,6.901 5.349,7.342 5.563,7.673 C5.777,8.004 6.219,8.099 6.551,7.886 L11.673,4.597 C11.877,4.466 12.000,4.241 12.000,3.999 C12.000,3.756 11.877,3.531 11.673,3.400 L6.551,0.112 C6.331,-0.030 6.051,-0.040 5.822,0.085 C5.592,0.210 5.449,0.449 5.449,0.710 L5.449,3.286 L0.000,3.286 "/>
                                    </svg> ${item.name}
                                </button>
                                <span>${item.countProduct}</span>
                            </li>
                        `;
                    }).join("");
                    $("#categories").html(content);
                    getProducts();
                }
            })
        }

        function getProducts(page = 1,append = false){
            let category = $("#change-products .close-change-cate").data('content') ?? 0;
            let keyword = $("#change-products .close-change-keyword").data('content') ?? '';
            let seal = $("#change-products .close-change-seal").data('content') ?? 0;
            let status = $("#change-products .close-change-status").data('content') ?? 'all';
            $.ajax({
                url: `{{route('api.products.index')}}?page=${page}&cate_id=${category}&keyword=${keyword}&seal=${seal}&status=${status}`,
                method: 'GET',
                success: function (response){
                    let data = response.data;
                    let content = data.map(function(item){
                        let sealNotify = '';
                        let logPrice = '';
                        let route = "{{route('admin.products.show',['slug','id'])}}".replace('slug',item.slug).replace('id',item.id);
                        let routeCate = "{{route('admin.products.categories',['id'])}}".replace('id',item.id);
                        if(item.price_seal > 0){
                            sealNotify = `<div class="product-overlay"><h4>-${item.price_seal} %</h4></div>`
                            logPrice = `<p><span>${(item.price).toLocaleString()} </span>${(item.price - (item.price_seal / 100 * item.price)).toLocaleString()}</p>`;
                        }else{
                            logPrice = `<p>${(item.price).toLocaleString()}</p>`;
                        }
                        return `
                            <li>
                                <div class="product-grid">
                                    <div class="product-item">
                                        <img src="${item.images[0]?.url}" alt="product-img"/>
                                        ${sealNotify}
                                        <div class="product-ovr-links">
                                            <ul  class="d-flex align-items-center justify-content-evenly">
                                                <li style="min-width: 50px">
                                                    <a href="${route}" class="btn p-0 fs-5 fw-normal text-white">
                                                        <i class="fas fa-box-open"></i>
                                                    </a>
                                                </li>
                                                <li style="min-width: 50px">
                                                    <a href="${routeCate}" class="btn p-0 fs-5 fw-normal text-white">
                                                        <i class="fas fa-layer-group"></i>
                                                    </a>
                                                </li>
                                                <li style="min-width: 50px">
                                                    <button data-id="${item.id}" data-status="${item.status == 0 ? 1 : 0}" class="btn-change-status btn p-0 fs-4 fw-normal text-white">
                                                        <i class="fas fa-toggle-${item.status == 0 ? 'on' : 'off'}"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-text-rs">
                                        <a href="javascript:;">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="fals"></i>
                                            <i class="fa fa-star" aria-hidden="fals"></i>
                                        </a>
                                        <small class="status-notify text-danger fw-bold">
                                            ${item.status != 0 ? "    (Ngừng bán)" : ''}
                                        </small>
                                        <h3><a href="${route}">${item.name}</a></h3>
                                        <h6>${item.desc_short.slice(0, 30)}...</h6>
                                        ${logPrice}
                                    </div>
                                </div>
                            </li>
                        `;
                    }).join('');
                    if(append){
                        $("#products").append(content);
                    }else{
                        $("#products").html(content);
                    }
                },
                error: function (log){
                    console.log(log);
                }
            });
        }


        // Search Category
        $(document).on('click','.btn-category',function(){
           let id = $(this).data('id');
           getCategories(id);
        });
        $(document).on('click','.close-change-cate',function(){
            getCategories(0);
        });
        $(document).on('click','.btn-back-category',function(){
           let id = $(this).data('id');
           let parent = id ?? 0;
           getCategories(parent);
        });


        // Keywords Search
        $(document).on('submit','#form-search',function(e){
           e.preventDefault();
           let input = $("#input-search").val();
           $("#change-products .close-change-keyword").remove();
           $("#change-products").append(`
               <button data-content="${input}" class="me-2 close-change-keyword d-block d-flex bg-white align-items-center justify-content-between py-2 border px-3">
                   <span>Tìm kiếm: ${input}</span>
                   <i class="ms-2 fs-5 pt-1 icofont-close-line"></i>
               </button>
           `);
            getProducts();
        });

        $(document).on('click','.close-change-keyword',function(){
            $(this).remove();
            getProducts();
        });

        // Seals Search
        $(document).on('change','.int-checkbox .seals',function (){
            $("#change-products .close-change-seal").remove();
            if($(this).prop('checked')){
                $("#change-products").append(`
                   <button data-content="${$(this).val()}" class="me-2 close-change-seal d-block d-flex bg-white align-items-center justify-content-between py-2 border px-3">
                       <span>Giảm giá: ${$(this).val()}%</span>
                       <i class="ms-2 fs-5 pt-1 icofont-close-line"></i>
                   </button>
                `);
                getProducts();
            }else{
                let listSeals = $(".int-checkbox .seals");
                let firstCheckedSeal = listSeals.filter(':checked').first();
                if(firstCheckedSeal.length > 0){
                    $("#change-products").append(`
                       <button data-content="${firstCheckedSeal.val()}" class="me-2 close-change-seal d-block d-flex bg-white align-items-center justify-content-between py-2 border px-3">
                           <span>Giảm giá: ${firstCheckedSeal.val()}%</span>
                           <i class="ms-2 fs-5 pt-1 icofont-close-line"></i>
                       </button>
                    `);
                }
            }
            getProducts();
        });
        $(document).on('click','.close-change-seal',function(){
            $(".int-checkbox .seals").prop('checked', false);
            $("#change-products .close-change-seal").remove();
            getProducts();
        });

        // Status Search
        $(document).on('change','.status-products',function (){
            $("#change-products .close-change-status").remove();
            if($(this).prop('checked')){
                $("#change-products").append(`
                   <button data-content="${$(this).val()}" class="me-2 close-change-status d-block d-flex bg-white align-items-center justify-content-between py-2 border px-3">
                       <span>Trạng thái: ${$(this).val() == 0 ? 'Đang bán' : 'Ngưng bán'}</span>
                       <i class="ms-2 fs-5 pt-1 icofont-close-line"></i>
                   </button>
                `);
                getProducts();
            }else{
                let listStatus = $(".status-products");
                let firstCheckStatus = listStatus.filter(':checked').first();
                if(firstCheckStatus.length > 0){
                    $("#change-products").append(`
                       <button data-content="${firstCheckStatus.val()}" class="me-2 close-change-status d-block d-flex bg-white align-items-center justify-content-between py-2 border px-3">
                           <span>Trạng thái: ${firstCheckStatus.val() == 0 ? 'Đang bán' : 'Ngưng bán'}</span>
                           <i class="ms-2 fs-5 pt-1 icofont-close-line"></i>
                       </button>
                    `);
                }
            }
            getProducts();
        });
        $(document).on('click','.close-change-status',function(){
            $(".status-products").prop('checked', false);
            $("#change-products .close-change-status").remove();
            getProducts();
        });


        // Scroll Products
        let page = 1;
        $(document).on('scroll',function (){
            if($(document).height() <= ($(window).height() + $(window).scrollTop())){
                page++;
                getProducts(page,true);
            }
        });

        // Change Status Product
        $(document).on('click','.btn-change-status',function (){
            let status = $(this).data('status');
            let id = $(this).data('id');
            let title = status == 1 ? 'Ngưng bán sản phẩm này!' : 'Mở bán sản phẩm này!';
            let that = $(this);
            let iTag = $(this).find('i');
            let smallTag = $(this).closest('.product-grid').find('.status-notify');
            swal({
                title: "Bạn chắc chứ?",
                text: title,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willChange) => {
                    if (willChange) {
                        $.ajax({
                            url: `{{route('api.products.update',['__id__'])}}`.replace('__id__',id),
                            method: 'PUT',
                            data: {status},
                            success: function(response){
                                swal("Chúc mừng thay đổi sản phẩm thành công!", {
                                    icon: "success",
                                });
                                let status = response.status;
                                if(status == 0){
                                    iTag.addClass('fa-toggle-on');
                                    iTag.removeClass('fa-toggle-off');
                                    smallTag.text('');
                                    that.data('status',1);
                                }else{
                                    iTag.addClass('fa-toggle-off');
                                    iTag.removeClass('fa-toggle-on');
                                    smallTag.text('   (Ngưng bán)');
                                    that.data('status',0);
                                }
                            }
                        });
                    }
                });
        });
    </script>
@endsection
