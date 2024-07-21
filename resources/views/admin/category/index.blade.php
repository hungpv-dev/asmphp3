@extends('layouts.admin')
@section('title')
    Danh mục
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="main-content">
            <!-- Page Title Start -->
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-title-wrapper">
                        <div class="page-title-box ad-title-box-use">
                            <h4 class="page-title">Danh mục</h4>
                        </div>
                        <div class="ad-breadcrumb">
                            <ul>
                                <li>
                                    <form method="GET" id="form-search-cate" class="ad-user-btn">
                                        <input class="form-control" type="search" id="keywords-search-cate" value="" name="keywords" placeholder="Tìm kiếm ở đây..." id="text-input">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 56.966 56.966">
                                            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23
												s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92
												c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17
												s-17-7.626-17-17S14.61,6,23.984,6z"></path>
                                        </svg>
                                    </form>
                                </li>
                                <li>
                                    <div class="add-group">
                                        <a class="ad-btn add-btn-category">Thêm danh mục</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table Start -->
            <div class="row">
                <!-- Styled Table Card-->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card table-card">
                        <div class="card-header pb-0">
                            <button class="btn-back-paginate btn p-0"><h4>< Danh sách danh mục</h4></button>
                            <button data-id="" id="name-cate-parent" class="btn p-0 text-decoration-underline fw-600"></button>
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
                                            <th>Hành động</th>
                                        </tr>
                                        </thead>
                                        <tbody id="list"></tbody>
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
    </div>
@endsection
@section('script')
    <script>
        function getListCategory(link = "{{route('api.categories.index')}}"+"?page=1",id = 'null',keywords = ''){
            let url = '';
            if(keywords==''){
                url = link+"&parent_id="+id;
            }else{
                url = link+"&keywords="+keywords;
            }
            $.ajax({
                url: url,
                method: 'GET',
                success: function(reponse){
                    let data = reponse.data;
                    let links = reponse.meta.links;
                    let page = reponse.meta.current_page;
                    let stt = (page-1) * reponse.meta.per_page;
                    let contents = data.map(function(item,index){
                        return `
                            <tr class="tr-parent-cate">
                                <td>${stt+index+1}</td>
                                <td>
                                     <span class="img-thumb d-block" style="width: 100% !important;">
                                         <span data-id="${item.ma}" style="width: 100%" class="d-block ml-2 name-category-edit" contenteditable>${item.ten}</span>
                                    </span>
                                </td>
                                <td><button data-id="${item.ma}" class="child-category btn p-0">Danh mục con</button></td>
                                <td>
                                    <label class="mb-0 label-toggle-${item.ma} badge ${item.trang_thai==0?'badge-primary':'badge-danger'}" title="Pending">
                                        ${item.trang_thai==0?'Hoạt động':'Ngưng bán'}
                                    </label>
                                </td>
                                <td class="relative">
                                    <a class="action-btn" href="javascript:void(0); ">
                                        <svg class="default-size" viewBox="0 0 341.333 341.333 ">
                                            <g>
                                                <g>
                                                    <g>
                                                        <path d="M170.667,85.333c23.573,0,42.667-19.093,42.667-42.667C213.333,19.093,194.24,0,170.667,0S128,19.093,128,42.667 C128,66.24,147.093,85.333,170.667,85.333z "></path>
                                                        <path d="M170.667,128C147.093,128,128,147.093,128,170.667s19.093,42.667,42.667,42.667s42.667-19.093,42.667-42.667 S194.24,128,170.667,128z "></path>
                                                        <path d="M170.667,256C147.093,256,128,275.093,128,298.667c0,23.573,19.093,42.667,42.667,42.667s42.667-19.093,42.667-42.667 C213.333,275.093,194.24,256,170.667,256z "></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </a>
                                    <div class="action-option ">
                                        <ul>
                                            <li>
                                                <button data-status="${item.trang_thai}" data-id="${item.ma}" class="toggleCategory btn py-0 text-white">
                                                    <i class="fas fa-edit mr-2 "></i>
                                                    <span class="span-toggle-${item.ma}">${item.trang_thai==0?'Ẩn':'Hiện'}</span>
                                                </button>
                                            </li>
                                            <li>
                                                    <button data-id="${item.ma}" class="delete-category btn py-0 text-white">
                                                        <i class="far fa-trash-alt mr-2 ">
                                                        </i>
                                                        Xóa</button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        `;
                    }).join("");
                    $("#list").html(contents);


                    let parentLink = '';
                    $("#parent_id").val(id);
                    if(keywords != ''){
                        parentLink = '&keywords='+keywords;
                    }else if(id != 'null'){
                        parentLink = '&parent_id='+id;
                        getCategory(id);
                    }
                    let next = reponse.links.next;
                    let prev = reponse.links.prev;
                    let classPaginatePrev = prev ? '' : 'disabled';
                    let classPaginateNext = next ? '' : 'disabled';
                    let paginateContent = '';
                    paginateContent += `
                        <li class="page-item ${classPaginatePrev}">
                            <button data-link="${prev+parentLink}" class="page-link paginate" tabindex="-1"><i class="fas fa-chevron-left"></i></button>
                        </li>
                    `;
                    links.shift();
                    links.pop();
                    paginateContent += links.map(function(item,index){
                        let classLabelPaginate = item.label == page ? 'btn btn-primary' : '';
                        if((index >= page-2) && (index <= page)){
                            return `
                                <li class="page-item">
                                    <button data-link="${item.url+parentLink}" class="${classLabelPaginate} page-link paginate">${item.label}</button>
                                </li>
                            `;
                        }
                    }).join("");
                    paginateContent += `
                        <li class="page-item ${classPaginateNext}">
                            <button data-link="${next+parentLink}" class="page-link paginate"><i class="fas fa-chevron-right "></i></button>
                        </li>
                    `;
                    $("#pagination").html(paginateContent);

                }
            })
        }

        function update(id,status,that){
            $.ajax({
                url: "{{route('api.categories.update',['__id__'])}}".replace('__id__',id),
                method: 'PUT',
                data: JSON.stringify({
                    status
                }),
                processData: false,
                contentType: 'application/json',
                success: function(response){
                    $(".span-toggle-"+response.id).text(response.title);
                    that.data('status',response.status);
                    let label = $(".label-toggle-"+response.id);
                    if(response.status == 0){
                        label.text("Hoạt động");
                        label.addClass('badge-primary');
                        label.removeClass('badge-danger');
                    }else{
                        label.text("Ngưng bán");
                        label.addClass('badge-danger');
                        label.removeClass('badge-primary');
                    }
                },
            });
        }

        function getCategory(id){
            $.ajax({
                url: "{{route('api.categories.show',['__id__'])}}".replace('__id__',id),
                method: 'GET',
                success: function(response){
                    $("#name-cate-parent").text("< "+response.name);
                }
            });
        }

        function updateText(id,text){
            $.ajax({
                url: "{{route('api.categories.update',['__id__'])}}".replace('__id__',id),
                method: 'PUT',
                data: JSON.stringify({
                    text
                }),
                processData: false,
                contentType: 'application/json',
                success: function(response){
                    swal({
                        title: "Thông báo",
                        text: "Cập nhật thành công",
                        icon: "success",
                        button: "Ok",
                    });
                },
                error: function(log){
                    swal({
                        title: "Thông báo",
                        text: log.responseJSON.errors.text[0],
                        icon: "error",
                        button: "Ok",
                    });
                }
            });
        }

        function searchKey(link,keywords){
            $.ajax({
                url: link+"&keywords="+keywords,
                method: 'GET',
                success: function(response){
                    console.log(response)
                },
            })
        }

        function deleteCate(id){
            $.ajax({
                url: "{{route("api.categories.destroy",['__id__'])}}".replace('__id__',id),
                method: 'DELETE',
                success: function(data){
                    if(data.length == 0){
                        swal({
                            title: "Thông báo",
                            text: "Xóa danh mục thành công",
                            icon: "success",
                            button: "Ok",
                        });
                    }else{
                        swal({
                            title: "Thông báo",
                            text: "Vui lòng xóa hết danh mục con trước!",
                            icon: "error",
                            button: "Ok",
                        });
                    }
                }
            });
        }

        function addCategory(name,parent_id){
            $.ajax({
                url: "{{route('api.categories.store')}}",
                method: 'POST',
                data: {name,parent_id},
                success: function(response){
                    console.log(response);
                    if(response){
                        swal({
                            title: "Thông báo",
                            text: "Thêm danh mục thành công",
                            icon: "success",
                            button: "Ok",
                        });
                    }
                },
                error: function(log){
                    swal({
                        title: "Thông báo",
                        text: log.responseJSON.errors.name[0],
                        icon: "error",
                        button: "Ok",
                    });
                }
            })
        }

        var pageOne = "{{route('api.categories.index')."?page=1"}}";
        $(document).ready(function(){
            getListCategory();
            $(document).on('click','.page-link.pagination',function(){
                let link = $(this).data('link');
                getListCategory(link,$("#parent_id").val(),$("#keywords-search-cate").val());
            });
            $(document).on('click','.child-category',function(){
                let id = $(this).data('id');
                getListCategory(pageOne,id);
            });
            $(document).on('click','.btn-back-pagination',function(){
                let id = $(this).data('id');
                $("#name-cate-parent").text("");
                getListCategory(pageOne);
            });
            $(document).on('click','.toggleCategory',function(){
               let id = $(this).data('id');
               let status = $(this).data('status');
               update(id,status,$(this));
            });
            $(document).on('blur','.name-category-edit',function(){
               let text = $(this).text();
               let id = $(this).data('id');
               updateText(id,text);
            });
            $(document).on('click','.delete-category',function(){
                if(confirm('Bạn có chắc chắn muốn xóa danh mục không?')){
                    let id = $(this).data('id');
                    deleteCate(id);
                    getListCategory(pageOne,$("#parent_id").val(),$("#keywords-search-cate").val());
                }
            });
            $(document).on('click','#name-cate-parent',function(){
                $("#name-cate-parent").text("");
                getListCategory(pageOne);
            });
            $(document).on('click','.add-btn-category',function(){
                let cate = $("#name-cate-parent").text() || 'Danh mục gốc';
                swal({
                    text: 'Thêm vào danh mục:  "'+cate+'"',
                    content: "input",
                    button: {
                        text: "Thêm",
                        closeModal: true,
                    },
                })
                    .then(name => {
                        addCategory(name,$("#parent_id").val());
                        getListCategory(pageOne,$("#parent_id").val());
                    })
            });
        })
        $(document).on('submit','#form-search-cate',function (e){
            e.preventDefault();
            let keywords = $("#keywords-search-cate").val();
            getListCategory(pageOne,'null',keywords);
        })
        $(document).on('input','#keywords-search-cate',function (e){
            if($(this).val() == ''){
                getListCategory(pageOne)
            }
        })
    </script>
@endsection
