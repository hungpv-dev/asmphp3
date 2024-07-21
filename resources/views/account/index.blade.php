@extends('account.layout-account')
@section('title')
    {{$title}}
@endsection
@section('main')
    <div class="account__content">
        <h2 class="account__content--title h3 mb-20">Lịch sử đơn hàng</h2>
        <div class="account__table--area">
            <table class="account__table">
                <thead class="account__table--header">
                <tr class="account__table--header__child">
                    <th class="account__table--header__child--items">Mã đơn hàng</th>
                    <th class="account__table--header__child--items">Ngày đặt</th>
                    <th class="account__table--header__child--items">Trạng thái</th>
                    <th class="account__table--header__child--items">PTTT</th>
                    <th class="account__table--header__child--items">Số tiền</th>
                    <th class="account__table--header__child--items">Thanh toán</th>
                    <th class="account__table--header__child--items">Thông tin</th>
                </tr>
                </thead>
                <tbody class="account__table--body mobile__none">
                @foreach($orders as $order)
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">#{{$order->id}}</td>
                    <td class="account__table--body__child--items">{{$order->created_at}}</td>
                    <td class="account__table--body__child--items">{{$order->trangThai->desc}}</td>
                    <td class="account__table--body__child--items">{{$order->payment}}</td>
                    <td class="account__table--body__child--items">{{number_format($order->price)}} VNĐ</td>
                    <td class="account__table--body__child--items">{!! $order->vnpay ? 'Đã TT' : ($order->payment == 'COD' ? 'Khi nhận hàng' : '<span class="text-danger">Chưa TT</span>') !!}</td>
                    <td class="account__table--body__child--items"><a href="{{route('order.show',[$order->id])}}">Chi tiết</a></td>
                </tr>
                @endforeach
                </tbody>
                <tbody class="account__table--body mobile__block">
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">
                        <strong>Order</strong>
                        <span>#2014</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Date</strong>
                        <span>November 24, 2022</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Payment Status</strong>
                        <span>Paid</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Fulfillment Status</strong>
                        <span>Unfulfilled</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Total</strong>
                        <span>$40.00 USD</span>
                    </td>
                </tr>
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">
                        <strong>Order</strong>
                        <span>#2014</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Date</strong>
                        <span>November 24, 2022</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Payment Status</strong>
                        <span>Paid</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Fulfillment Status</strong>
                        <span>Unfulfilled</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Total</strong>
                        <span>$40.00 USD</span>
                    </td>
                </tr>
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">
                        <strong>Order</strong>
                        <span>#2014</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Date</strong>
                        <span>November 24, 2022</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Payment Status</strong>
                        <span>Paid</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Fulfillment Status</strong>
                        <span>Unfulfilled</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Total</strong>
                        <span>$40.00 USD</span>
                    </td>
                </tr>
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">
                        <strong>Order</strong>
                        <span>#2014</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Date</strong>
                        <span>November 24, 2022</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Payment Status</strong>
                        <span>Paid</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Fulfillment Status</strong>
                        <span>Unfulfilled</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Total</strong>
                        <span>$40.00 USD</span>
                    </td>
                </tr>
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">
                        <strong>Order</strong>
                        <span>#2014</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Date</strong>
                        <span>November 24, 2022</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Payment Status</strong>
                        <span>Paid</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Fulfillment Status</strong>
                        <span>Unfulfilled</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Total</strong>
                        <span>$40.00 USD</span>
                    </td>
                </tr>
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">
                        <strong>Order</strong>
                        <span>#2014</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Date</strong>
                        <span>November 24, 2022</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Payment Status</strong>
                        <span>Paid</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Fulfillment Status</strong>
                        <span>Unfulfilled</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Total</strong>
                        <span>$40.00 USD</span>
                    </td>
                </tr>
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">
                        <strong>Order</strong>
                        <span>#2014</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Date</strong>
                        <span>November 24, 2022</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Payment Status</strong>
                        <span>Paid</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Fulfillment Status</strong>
                        <span>Unfulfilled</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Total</strong>
                        <span>$40.00 USD</span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

