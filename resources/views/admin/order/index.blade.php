@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection
@section('content')
    <!-- Container Start -->
    <div class="page-wrapper">
        <div class="main-content">
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
            <!-- Table Start -->
            <div class="row">
                <!-- Styled Table Card-->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card table-card">
                        <div class="card-header pb-0">
                            <h4>Danh sách đơn hàng</h4>
                        </div>
                        <div class="card-body">
                            <div class="chart-holder">
                                <div class="table-responsive">
                                    <table class="table table-styled mb-0">
                                        <thead>
                                        <tr>
                                            <th>
                                                <div class="checkbox">
                                                    <input id="checkbox1" type="checkbox">
                                                    <label for="checkbox1"></label>
                                                </div>
                                            </th>
                                            <th>Mã</th>
                                            <th>Người nhận</th>
                                            <th>Thời gian đặt</th>
                                            <th>Số lượng</th>
                                            <th>Giá tiền</th>
                                            <th>Trạng thái</th>
                                            <th>PTTT</th>
                                            <th>Chi tiết</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <input id="checkbox2" type="checkbox">
                                                    <label for="checkbox2"></label>
                                                </div>
                                            </td>
                                            <td>#{{$order->id}}</td>
                                            <td>
                                                <span class="img-thumb">
                                                    <img src="{{$order->userImage()}}" alt=" ">
                                                    <span class="ml-2 ">{{$order->full_name}}</span>
                                                </span>
                                            </td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->count}}</td>
                                            <td>{{number_format($order->price)}} VNĐ</td>
                                            <td>
                                                <label class="mb-0 badge badge-primary" title="" data-original-title="Pending">{{$order->trangThai->desc}}</label>
                                            </td>
                                            <td>
                                                <span class="img-thumb">
                                                    @if($order->payment !== 'COD')
                                                    <i class="fas fa-credit-card"></i>
                                                    @endif
                                                    <span class="ml-2">{{$order->payment}}</span>
                                                </span>
                                            </td>
                                            <td>
                                                <label class="mb-0 badge badge-primary" title="" data-original-title="Pending"><a
                                                        href="{{route('admin.order.detail',[$order->id])}}" class="text-white">Chi tiết</a></label>
                                            </td>
                                            <td class="relative">
                                                <a class="action-btn " href="javascript:void(0); ">
                                                    <svg class="default-size " viewBox="0 0 341.333 341.333 ">
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
                                                            <a href="javascript:void(0); "><i class="far fa-edit mr-2 "></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0); "><i class="far fa-trash-alt mr-2 "></i>Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="text-right pt-2">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0 ">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="javascript:void(0);" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active "><a class="page-link " href="javascript:void(0); ">1</a></li>
                                        <li class="page-item ">
                                            <a class="page-link " href="javascript:void(0); ">2</a>
                                        </li>
                                        <li class="page-item "><a class="page-link " href="javascript:void(0); ">3</a></li>
                                        <li class="page-item ">
                                            <a class="page-link " href="javascript:void(0); "><i class="fas fa-chevron-right "></i></a>
                                        </li>
                                    </ul>
                                </nav>
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
@endsection
