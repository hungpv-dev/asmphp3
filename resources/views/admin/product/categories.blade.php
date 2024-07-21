@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="main-content">
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
                                <li class="breadcrumb-link active">Danh mục sản phẩm</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Products view Start -->
            <h3 class="alert alert-success text-center">{{$product->name}}</h3>
            <hr>
            <h4>Danh mục hiện có</h4>
            <form action="{{route('admin.products.store.categories')}}" method="POST">
                @csrf
                <div class="d-flex flex-wrap list-present">
                    @foreach($product->categories as $category)
                        <div class="form-check m-2">
                            <input class="form-check-input btn-cate-present" value="{{$category->id}}"
                                   name="cate-{{$category->id}}" checked type="checkbox" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{$category->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="idProduct" value="{{$product->id}}">
                <button class="ad-btn btn btn-primary">Lưu thông tin</button>
            </form>
            <hr>
            <div id="listCategory">
                <div class="row">
                    <!-- Styled Table Card-->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card table-card">
                            <div class="card-header pb-0">
                                <button class="btn-back-paginate btn p-0"><h4>< Danh sách danh mục</h4></button>
                                <button id="name-cate-parent"
                                        class="btn-back-paginate btn p-0 text-decoration-underline fw-600"></button>
                            </div>
                            <div class="card-body">
                                <div class="chart-holder">
                                    <div class="table-responsive">
                                        <table class="table table-styled mb-0">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Danh mục</th>
                                                <th>Cấp danh mục</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                            </thead>
                                            <tbody id="list">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <nav class="d-inline-block">
                                        <ul id="paginate" class="pagination mb-0 ">
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="" id="parent_id">
                    <div class="ad-footer-btm">
                        <p>Copyright 2022 © SplashDash All Rights Reserved.</p>
                    </div>
                </div>

            </div>
            <input type="hidden" id="parent_id" value="null">
            <!--===Products Details===-->
            <div class="ad-footer-btm">
                <p>Copyright 2022 © SplashDash All Rights Reserved.</p>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function getCategory(link = "{{route('api.categories.index')}}?page=1", idParent = null) {
            let url = link + "&parent_id=" + idParent;
            let listPresent = [...document.querySelectorAll('.list-present input')].map(item => {
                return parseInt(item.value);
            });
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    let data = response.data;
                    let content = data.map(item => {
                        let check = listPresent.includes(item.ma) ? 'checked' : '';
                        return `
                            <tr>
                                <td>
                                    <input ${check} class="form-check-input cate cate-${item.ma}" value="${item.ma}" type="checkbox" id="flexCheckDefault-${item.ma}">
                                </td>
                                <td><label class="label-check" for="flexCheckDefault-${item.ma}">${item.ten}</label></td>
                                <td><button type="button" class="btn-child-cate" data-id="${item.ma}">Danh mục con</button></td>
                                <td>${item.trang_thai == 0 ? 'Hoạt động' : 'Ngừng bán'}</td>
                            </tr>
                        `;
                    }).join('');
                    $("#list").html(content);
                    let links = response.meta.links;
                    let paginate = links.map((item, index) => {
                        let label = item.label;
                        let classDisable = item.url == null ? 'disabled' : '';
                        if (index == 0) {
                            label = '<i class="fas fa-chevron-left"></i>';
                        } else if (index == links.length - 1) {
                            label = '<i class="fas fa-chevron-right "></i>';
                        }

                        return `
                            <li class="page-item">
                                <button data-link="${item.url}" class="btn ${classDisable} btn-primary text-white page-link paginate">${label}</button>
                            </li>
                        `;

                    }).join('');
                    $("#pagination").html(paginate);
                }
            })
        }

        function getCate(id) {
            $.ajax({
                url: "{{route('api.categories.show',['id'])}}".replace('id', id),
                method: 'GET',
                success: function (response) {
                    $("#name-cate-parent").text(" <" + response.name);
                }
            });
        }

        $(document).on('change', '.form-check-input.cate', function () {
            if($(this).prop('checked')){
                let label = $(this).closest('tr').find('.label-check').text();
                $(".list-present").append(`
                    <div class="form-check m-2">
                        <input class="form-check-input btn-cate-present" value="${$(this).val()}"
                                       name="cate-${$(this).val()}" checked type="checkbox" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            ${label}
                        </label>
                    </div>
                `);
            }
        });

        $(document).on('change', '.btn-cate-present', function () {
            $(this).closest('.form-check').remove();
            let id = $(this).val();
            $('.cate-'+id).prop('checked', false);
        });
        $(document).ready(function () {
            getCategory();
        })
        $(document).on('click', '.btn-back-pagination', function () {
            $("#parent_id").val('null');
            $("#name-cate-parent").text("");
            getCategory();
        });
        $(document).on('click', '.btn-child-cate', function () {
            let id = $(this).data('id');
            $("#parent_id").val(id);
            getCate($("#parent_id").val());
            getCategory("{{route('api.categories.index')}}?page=1", id);
        });
        $(document).on('click', '.page-link', function () {
            let link = $(this).data('link');
            getCategory(link, $("#parent_id").val());
        });
    </script>
@endsection
