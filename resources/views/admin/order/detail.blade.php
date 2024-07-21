@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection
@section('content')
    <!-- Container Start -->
    <div class="page-wrapper">
        <div class="main-content position-relative">
            <!-- Page Title Start -->
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-title-wrapper">
                        <div class="page-title-box ad-title-box-use">
                            <h4 class="page-title">Đơn hàng</h4>
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
                                        <a class="ad-btn">Add New Order</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h4 class="alert alert-success text-center">Thông tin đơn hàng</h4>
                <form action="{{route('admin.order.update',[$order->id])}}" method="POST" class="row">
                    @csrf
                    @method('PUT')
                    <table class="table m-auto" style="width:50%">
                        <thead>
                            <tr>
                                <th>Thuộc tính</th>
                                <th style="text-align: end">Thông tin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tên người nhận</td>
                                <td style="text-align: end">{{$order->full_name}}</td>
                            </tr>
                            <tr>
                                <td>Số điện thoại</td>
                                <td style="text-align: end">{{$order->tel}}</td>
                            </tr>
                            <tr>
                                <td>Địa chỉ</td>
                                <td style="text-align: end">{{$order->address}}</td>
                            </tr>
                            <tr>
                                <td>Số sản phẩm</td>
                                <td style="text-align: end">{{$order->count}}</td>
                            </tr>
                            <tr>
                                <td>Số tiền</td>
                                <td style="text-align: end">{{number_format($order->price)}}</td>
                            </tr>
                            <tr>
                                <td>Phí vận chuyển</td>
                                <td style="text-align: end">{{number_format($order->ship)}}</td>
                            </tr>
                            @if($order->gift)
                                <tr>
                                    <td>Mã giảm giá</td>
                                    <td style="text-align: end">{{$order->gift->code}}</td>
                                </tr>
                            @endif
                            <tr>
                                <td>Phương thức thanh toán</td>
                                <td style="text-align: end">{{$order->payment}}</td>
                            </tr>
                            <tr>
                                <td>Ghi chú</td>
                                <td style="text-align: end">{{$order->note}}</td>
                            </tr>
                            <tr>
                                <td>Ngày đặt hàng</td>
                                <td style="text-align: end">{{$order->created_at}}</td>
                            </tr>
                            <tr>
                                <td>Trạng thái</td>
                                <td style="text-align: end">
                                    <select name="status" id="">
                                        @foreach($status as $st)
                                            <option {{$order->status == $st->id ? 'selected' : ''}} value="{{$st->id}}">{{$st->desc}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="text-align: end">
                                    <button type="submit" class="effect-btn btn btn-primary mt-2 mr-2 sm-btn">Cập nhật</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <!-- Table Start -->
            <div class="row">
                <!-- Styled Table Card-->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card table-card">
                        <div class="card-header pb-0">
                            <h4>Danh sách sản phẩm</h4>
                        </div>
                        <div class="card-body">
                            <div class="chart-holder">
                                <div class="table-responsive">
                                    <table class="table table-styled mb-0">
                                        <thead>
                                        <tr>
                                            <th>Ảnh sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Màu sản phẩm</th>
                                            <th>Cỡ sản phẩm</th>
                                            <th>Giá tiền</th>
                                            <th>Số lượng</th>
                                            <th>Tổng tiền</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->products as $product)
                                        <tr>
                                            <td>
                                                <img src="{{$product->image}}" style="width: 100px" alt="">
                                            </td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->color}}</td>
                                            <td>{{$product->size}}</td>
                                            <td>{{number_format($product->price / $product->count)}}</td>
                                            <td>{{$product->count}}</td>
                                            <td>{{number_format($product->price)}} VNĐ</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 px-3 bg-white mb-4 d-flex justify-content-between align-items-center position-sticky rounded" style="bottom: 0; z-index: 1000; height: 120px;box-shadow: 0px 12px 23px 0px rgba(62, 73, 84, 0.04);">
                <div>
                    <p class="text-danger">Tiền đơn hàng</p>
                    @if($order->gift)
                    <p class="text-danger">Mã giảm giá</p>
                    @endif
                    <p class="text-danger">Phí vận chuyển</p>
                    <p class="text-danger">Tiền thanh toán</p>
                </div>
                <div>
                    @if($order->gift)
                        <p>{{number_format($order->price - $order->ship + $order->gift->price )}} VNĐ</p>
                        <p>{{number_format($order->gift->price)}} VNĐ</p>
                    @else
                        <p>{{number_format($order->price - $order->ship )}} VNĐ</p>
                    @endif
                    <p>{{number_format($order->ship)}} VNĐ</p>
                    <p>{{number_format($order->price)}} VNĐ</p>
                </div>
            </div>
            <div class="ad-footer-btm">
                <p>Copyright 2022 © SplashDash All Rights Reserved.</p>
            </div>
        </div>
    </div>
@endsection
