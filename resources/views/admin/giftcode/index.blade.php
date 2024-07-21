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
                            <h4 class="page-title">Phí vận chuyển</h4>
                        </div>
                        <div class="ad-breadcrumb">
                            <ul>
                                <li>
                                    <div class="ad-user-btn">
                                        <input class="form-control" type="text" placeholder="Search Here..." id="text-input">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 56.966 56.966">
                                            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23
												s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92
												c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17
												s-17-7.626-17-17S14.61,6,23.984,6z"></path>
                                        </svg>
                                    </div>
                                </li>
                                <li>
                                    <div class="add-group">
                                        <a class="ad-btn" href="{{route('admin.giftcode.create')}}">Thêm mã giảm giá</a>
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
                            <h4>Danh sách phí vận chuyển</h4>
                        </div>
                        <div class="card-body">
                            <div class="chart-holder">
                                <div class="table-responsive">
                                    <table class="table table-styled mb-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Mã</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                            <th>Áp dụng cho đơn</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th>Hạn tới</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($giftcodes as $index => $code)
                                                <tr>
                                                    <td>{{$index+1}}</td>
                                                    <td>{{$code->code}}</td>
                                                    <td>{{$code->count}}</td>
                                                    <td>{{number_format($code->price)}}</td>
                                                    <td>{{number_format($code->min_order)}}</td>
                                                    <td>{{$code->status == 1 ? 'Hủy bỏ' : (now() > $code->max_time ? 'Hết hạn' : 'Hoạt động')}}</td>
                                                    <td>{{$code->created_at}}</td>
                                                    <td>{{$code->max_time}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
