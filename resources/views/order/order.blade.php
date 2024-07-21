@extends('order.layout-order')
<!-- Start checkout page area -->
@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="main checkout__mian">
        <header class="main__header checkout__mian--header mb-30">
            <h1 class="main__logo--title"><a class="logo logo__left mb-20" href="{{route('home')}}"><img src="{{asset('assets/img/logo/nav-log.png')}}" alt="logo"></a></h1>
            <details class="order__summary--mobile__version">
                <summary class="order__summary--toggle border-radius-5">
                    <span class="order__summary--toggle__inner">
                        <span class="order__summary--toggle__icon">
                            <svg width="20" height="19" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.178 13.088H5.453c-.454 0-.91-.364-.91-.818L3.727 1.818H0V0h4.544c.455 0 .91.364.91.818l.09 1.272h13.45c.274 0 .547.09.73.364.18.182.27.454.18.727l-1.817 9.18c-.09.455-.455.728-.91.728zM6.27 11.27h10.09l1.454-7.362H5.634l.637 7.362zm.092 7.715c1.004 0 1.818-.813 1.818-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817zm9.18 0c1.004 0 1.817-.813 1.817-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <span class="order__summary--toggle__text show">
                            <span>Danh sách sản phẩm</span>
                            <svg width="11" height="6" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle__dropdown" fill="currentColor"><path d="M.504 1.813l4.358 3.845.496.438.496-.438 4.642-4.096L9.504.438 4.862 4.534h.992L1.496.69.504 1.812z"></path></svg>
                        </span>
                        <span class="order__summary--final__price">{{number_format($order->price)}} VNĐ</span>
                    </span>
                </summary>
                <div class="order__summary--section">
                    <div class="cart__table checkout__product--table">
                        <table class="summary__table">
                            <tbody class="summary__table--body">
                            @foreach($order->products as $product)
                            <tr class=" summary__table--items">
                                <td class=" summary__table--list">
                                    <div class="product__image two  d-flex align-items-center">
                                        <div class="product__thumbnail border-radius-5">
                                            <a href="{{route('product.detail',[$product->slug,$product->product_id])}}"><img class="border-radius-5" src="{{$product->image}}" alt="cart-product"></a>
                                            <span class="product__thumbnail--quantity">{{$product->count}}</span>
                                        </div>
                                        <div class="product__description">
                                            <h3 class="product__description--name h4"><a href="{{route('product.detail',[$product->slug,$product->product_id])}}">{{$product->name}}</a></h3>
                                            <span class="product__description--variant text-dark">Màu: {{$product->color}}</span>
                                            <span class="product__description--variant text-dark">Cỡ: {{$product->size}}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class=" summary__table--list">
                                    <span class="cart__price">{{number_format($product->price)}}</span>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="checkout__total">
                        <table class="checkout__total--table">
                            <tbody class="checkout__total--body">
                            <tr class="checkout__total--items">
                                <td class="checkout__total--title text-left">Tổng đơn hàng:</td>
                                <td class="checkout__total--amount text-right price"></td>
                            </tr>
                            @if($order->gift)
                                <tr class="checkout__total--items">
                                    <td class="checkout__total--title text-left">Mã giảm giá: </td>
                                    <td class="checkout__total--amount text-right ">{{number_format($order->gift->price)}} VNĐ</td>
                                </tr>
                            @endif
                            <tr class="checkout__total--items">
                                <td class="checkout__total--title text-left">Phí vận chuyển:</td>
                                <td class="checkout__total--calculated__text text-right ship">{{number_format($order->ship)}} VNĐ</td>
                            </tr>
                            </tbody>
                            <tfoot class="checkout__total--footer">
                            <tr class="checkout__total--footer__items">
                                <td class="checkout__total--footer__title checkout__total--footer__list text-left">Thanh toán:</td>
                                <td class="checkout__total--footer__amount checkout__total--footer__list text-right">{{number_format($order->price)}} VNĐ</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </details>
        </header>
        <main class="main__content_wrapper">
            <form action="#">
                <div class="checkout__content--step section__shipping--address pt-0">
                    <div class="section__header checkout__header--style3 position__relative mb-25">
                        <span class="checkout__order--number">Mã đơn hàng: #{{$order->id}}</span>
                        <h2 class="section__header--title h3">Cảm ơn đã mua hàng</h2>
                        <div class="checkout__submission--icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25.995" height="25.979" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M416 128L192 384l-96-96"/></svg>
                        </div>
                    </div>
                    <div class="order__confirmed--area border-radius-5 mb-15">
                        <h3 class="order__confirmed--title h4">Đơn hàng của bạn đã được xác nhận</h3>
                        <p class="order__confirmed--desc">Bạn sẽ sớm nhận được email xác nhận kèm theo số đơn đặt hàng của bạn</p>
                    </div>
                    <div class="customer__information--area border-radius-5">
                        <h3 class="customer__information--title h4">Thông tin khách hàng</h3>
                        <div class="customer__information--inner d-flex">
                            <div class="customer__information--list">
                                <div class="customer__information--step">
                                    <h4 class="customer__information--subtitle h5">Thông tin liên lạc</h4>
                                    <ul>
                                        <li><a class="customer__information--text__link" href="#">{{$order->tel}}</a></li>
                                    </ul>
                                </div>
                                <div class="customer__information--step">
                                    <h4 class="customer__information--subtitle h5">Địa chỉ giao hàng</h4>
                                    <ul>
                                        <li><span class="customer__information--text">Số 2a ngõ 173, Phương Canh, Thị Cấm</span></li>
                                        <li><span class="customer__information--text">Xuân Phương</span></li>
                                        <li><span class="customer__information--text">Nam Từ Liêm</span></li>
                                        <li><span class="customer__information--text">Hà Nội</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="customer__information--list">
                                <div class="customer__information--step">
                                    <h4 class="customer__information--subtitle h5">Thông tin người nhận</h4>
                                    <ul>
                                        <li><span class="customer__information--text">-{{$order->full_name}}</span></li>
                                        <li><span class="customer__information--text">-{{$order->address}}</span></li>
                                    </ul>
                                </div>
                                <div class="customer__information--step">
                                    <h4 class="customer__information--subtitle h5">Phương thức thanh toán</h4>
                                    <ul>
                                        <li><span class="customer__information--text">{{$order->payment}}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="checkout__content--step__footer d-flex align-items-center">
                    <a class="continue__shipping--btn primary__btn border-radius-5" href="{{route('account.show')}}">Quay lại</a>
                </div>
            </form>
        </main>
        <footer class="main__footer checkout__footer">
            <p class="copyright__content">Copyright © 2022 <a class="copyright__content--link text__primary" href="index.html">Suruchi</a> . All Rights Reserved.Design By Suruchi</p>
        </footer>
    </div>
    <aside class="checkout__sidebar sidebar">
        <div class="cart__table checkout__product--table">
            <table class="cart__table--inner">
                <tbody class="cart__table--body">
                @foreach($order->products as $product)
                <tr class="cart__table--body__items">
                    <td class="cart__table--body__list">
                        <div class="product__image two  d-flex align-items-center">
                            <div class="product__thumbnail border-radius-5">
                                <a href="{{route('product.detail',[$product->slug,$product->product_id])}}"><img class="border-radius-5" src="{{$product->image}}" alt="cart-product"></a>
                                <span class="product__thumbnail--quantity">{{$product->count}}</span>
                            </div>
                            <div class="product__description">
                                <h3 class="product__description--name h4"><a href="{{route('product.detail',[$product->slug,$product->product_id])}}">{{$product->name}}</a></h3>
                                <span class="product__description--variant text-dark">Màu: {{$product->color}}</span>
                                <span class="product__description--variant text-dark">Cỡ: {{$product->size}}</span>
                            </div>
                        </div>
                    </td>
                    <td class="cart__table--body__list">
                        <span class="cart__price price__product">{{number_format($product->price)}}</span>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="checkout__total">
            <table class="checkout__total--table">
                <tbody class="checkout__total--body">
                <tr class="checkout__total--items">
                    <td class="checkout__total--title text-left">Tiền sản phẩm: </td>
                    <td class="checkout__total--amount text-right price"></td>
                </tr>
                @if($order->gift)
                <tr class="checkout__total--items">
                    <td class="checkout__total--title text-left">Mã giảm giá: </td>
                    <td class="checkout__total--amount text-right ">{{number_format($order->gift->price)}} VNĐ</td>
                </tr>
                @endif
                <tr class="checkout__total--items">
                    <td class="checkout__total--title text-left ship">Phí vận chuyển:</td>
                    <td class="checkout__total--calculated__text text-right">{{number_format($order->ship)}} VNĐ</td>
                </tr>
                </tbody>
                <tfoot class="checkout__total--footer">
                <tr class="checkout__total--footer__items">
                    <td class="checkout__total--footer__title checkout__total--footer__list text-left">Thanh toán:</td>
                    <td class="checkout__total--footer__amount checkout__total--footer__list text-right">{{number_format($order->price)}} VNĐ</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </aside>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            totalPriceCart();
            function totalPriceCart(){
                let spans = $('.cart__price.price__product');
                let sum = 0;
                for(const span of spans){
                    sum += +(span.innerText.replace(/,/g, ''));
                }
                let value = Math.floor(sum).toLocaleString('en-US');
                console.log(value);
                $(".price").text(value+ ' VNĐ');
                $("#total-phone").text(value+ ' VNĐ');
                $(".phone-price").text(value+ ' VNĐ');
            }
        });
    </script>
@endsection
<!-- End checkout page area -->
