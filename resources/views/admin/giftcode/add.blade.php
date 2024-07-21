@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="main-content">
            <!-- Page Title Start -->
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-title-wrapper">
                        <div class="page-title-box ad-title-box-use">
                            <h4 class="page-title">Thêm mã giảm giá</h4>
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
                            <h4>Thêm mã giảm giá</h4>
                        </div>
                        <div class="card-body row">
                            <form id="form-feeship" action="{{route('admin.giftcode.store')}}" method="POST" class="col-11 col-sm-8 col-xl-6 rounded m-auto border border-dark bg-white border-dark">
                            @csrf
                                <div class="mb-3  position-relative">
                                    <label for="" class="form-label">Mã giảm giá</label>
                                    <div class="position-relative">
                                    <input type="text" id="code" value="{{old('code')}}" class="form-control" name="code">
                                    <div class="position-absolute toggle-code" style="top: 50%; right: 2%; transform: translate(-50%,-50%); cursor: pointer">
                                        <i class="fs-4 fas fa-random"></i>
                                    </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Số lượng</label>
                                    <input type="number" value="{{old('count')}}" id="count" min="0" class="form-control"  name="count">
                                    <p class="text-danger" id="error-count"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Giá tiền</label>
                                    <input type="text" value="{{old('price')}}" oninput="formatCurrency(this)" name="price" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Áp dụng cho đơn hàng lớn hơn hoặc bằng</label>
                                    <input type="text" value="{{old('min_order')}}" oninput="formatCurrency(this)" name="min_order" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Thời gian hết hạn</label>
                                    <input name="max_time" value="{{old('max_time')}}" type="datetime-local" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Trạng thái</label>
                                    <select name="status" class="form-select">
                                        <option value="0">Hoạt động</option>
                                        <option value="1">Hủy bỏ</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-outline-primary border">Thêm mã</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="ad-footer-btm">
                    <p>Copyright 2022 © SplashDash All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function generateRandomString(length) {
            let result = '';
            let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }


        $(document).on('click','.toggle-code',function(){
            let random = generateRandomString(20);
            $("#code").val(random.toUpperCase());
        });
        $(document).on('input','#code',function(){
           let value = $(this).val().replace(/[^\w\s]/gi, '').replace(/\s/g, '');
           $(this).val(value.toUpperCase());
        });
        $(document).on('input','#count',function(){
           let value = $(this).val();
           if(value < 0 || isNaN(value)){
                $("#error-count").text('Số lượng không hợp lệ');
           }else{
               $("#error-count").text('');
           }
        });
    </script>
@endsection
