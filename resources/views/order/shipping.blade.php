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
                        <span class="order__summary--final__price" id="total-phone"></span>
                    </span>
                </summary>
                <div class="order__summary--section">
                    <div class="cart__table checkout__product--table">
                        <table class="summary__table">
                            <tbody class="summary__table--body">
                            @foreach($carts as $cart)
                                <tr class=" summary__table--items">
                                    <td class=" summary__table--list">
                                        <div class="product__image two  d-flex align-items-center">
                                            <div class="product__thumbnail border-radius-5">
                                                <a href="{{route('product.detail',[$cart->conditions['slug'],$cart->conditions['product_id']])}}"><img class="border-radius-5" src="{{$cart->conditions['image']}}" alt="cart-product"></a>
                                                <span class="product__thumbnail--quantity">{{$cart->quantity}} VNĐ</span>
                                            </div>
                                            <div class="product__description">
                                                <h3 class="product__description--name h4"><a href="{{route('product.detail',[$cart->conditions['slug'],$cart->conditions['product_id']])}}">{{$cart->name}}</a></h3>
                                                <span class="product__description--variant text-dark">Màu: {{$cart->attributes['color']}}</span>
                                                <span class="ms-1 product__description--variant text-dark">Cỡ: {{$cart->attributes['size']}}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class=" summary__table--list">
                                        <span class="cart__price">{{number_format(($cart->price - ($cart->conditions['price_seal'] / 100 * $cart->price))*$cart->quantity)}}</span>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="checkout__total">
                        <table class="checkout__total--table">
                            <tbody class="checkout__total--body">
                            <tr class="checkout__total--items">
                                <td class="checkout__total--title text-left">Tổng tiền</td>
                                <td class="checkout__total--amount text-right phone-price"></td>
                            </tr>
                            <tr class="checkout__total--items">
                                <td class="checkout__total--title text-left">Tiền vận chuyển</td>
                                <td class="checkout__total--calculated__text text-right">Tính ở bước tiếp theo</td>
                            </tr>
                            </tbody>
                            <tfoot class="checkout__total--footer">
                            <tr class="checkout__total--footer__items">
                                <td class="checkout__total--footer__title checkout__total--footer__list text-left">Tổng đơn hàng</td>
                                <td class="checkout__total--footer__amount checkout__total--footer__list text-right phone-price two"></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </details>
            <nav>
                <ol class="breadcrumb checkout__breadcrumb d-flex">
                    <li class="breadcrumb__item breadcrumb__item--completed d-flex align-items-center">
                        <a class="breadcrumb__link" href="{{route('cart.show')}}">Giỏ hàng</a>
                        <svg class="readcrumb__chevron-icon" xmlns="http://www.w3.org/2000/svg" width="17.007" height="16.831" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M184 112l144 144-144 144"></path></svg>
                    </li>

                    <li class="breadcrumb__item breadcrumb__item--current d-flex align-items-center">
                        <a class="breadcrumb__link" href="{{route('order.info')}}">Thông tin nhận hàng</a>
                        <svg class="readcrumb__chevron-icon" xmlns="http://www.w3.org/2000/svg" width="17.007" height="16.831" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M184 112l144 144-144 144"></path></svg>
                    </li>
                    <li class="breadcrumb__item breadcrumb__item--blank d-flex align-items-center">
                        <span class="breadcrumb__text">Vận chuyển</span>
                        <svg class="readcrumb__chevron-icon" xmlns="http://www.w3.org/2000/svg" width="17.007" height="16.831" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M184 112l144 144-144 144"></path></svg>
                    </li>
                    <li class="breadcrumb__item breadcrumb__item--blank">
                        <span class="breadcrumb__text">Thanh toán</span>
                    </li>
                </ol>
            </nav>
        </header>
        <main class="main__content_wrapper">
            <form action="{{route('order.save')}}" method="POST">
                @csrf
                <div class="checkout__content--step checkout__contact--information2 border-radius-5">
                    <div class="checkout__review d-flex justify-content-between align-items-center">
                        <div class="checkout__review--inner d-flex align-items-center">
                            <label class="checkout__review--label">Liên hệ</label>
                            <span class="checkout__review--content">{{$tel}}</span>
                        </div>
                    </div>
                    <div class="checkout__review d-flex justify-content-between align-items-center">
                        <div class="checkout__review--inner d-flex align-items-center">
                            <label class="checkout__review--label">Địa điểm</label>
                            <span class="checkout__review--content">{{$address}}</span>
                        </div>
                    </div>
                    <div class="checkout__review d-flex justify-content-between align-items-center">
                        <div class="checkout__review--inner d-flex align-items-center">
                            <label class="checkout__review--label">Giá tiền</label>
                            <span class="checkout__review--content"> {{number_format($total)}} <span class="text-danger">VNĐ</span></span>
                        </div>
                    </div>
                </div>
                <div class="checkout__content--step section__shipping--address">
                    <div class="section__header mb-25">
                        <h3 class="section__header--title">Phương thức thanh toán</h3>
                    </div>
                    <div class="checkout__content--step__inner3 border-radius-5">
                        <div class="checkout__address--content__header d-flex align-items-center justify-content-between">
                            <span class="checkout__address--content__title">Chọn phương thức thanh toán mà bạn muốn</span>
                            <span class="heckout__address--content__icon"><img src="{{asset('assets/img/icon/credit-card.svg')}}" alt="card"></span>
                        </div>
                        <div class="checkout__content--input__box--wrapper ">
                            <div class="row">
                                <div class="col-12 mb-12">
                                    <div class="checkout__input--list position__relative">
                                        <label>
                                            <select name="payment" id="" class="checkout__input--field border-radius-5">
                                                <option value="COD">Thanh toán khi nhận hàng</option>
                                                <option value="VNPAY">Thanh toán bằng ví VNPay</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="price" value="{{$total}}">
                <input type="hidden" name="note" value="{{$note}}">
                <input type="hidden" name="tel" value="{{$tel}}">
                <input type="hidden" name="address" value="{{$address}}">
                <input type="hidden" name="fullname" value="{{$fullname}}">
                <input type="hidden" name="voucher" value="{{$voucher ? $voucher->id : NULL}}">
                <input type="hidden" name="ship" value="{{$priceShip}}">
                <div class="checkout__content--step__footer d-flex align-items-center mt-4">
                    <button class="continue__shipping--btn primary__btn border-radius-5">Mua hàng</button>
                    <a class="previous__link--content" href="{{route('order.info')}}">Quay lại</a>
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
                @foreach($carts as $cart)
                    <tr class="cart__table--body__items">
                        <td class="cart__table--body__list">
                            <div class="product__image two  d-flex align-items-center">
                                <div class="product__thumbnail border-radius-5">
                                    <a href="{{route('product.detail',[$cart->conditions['slug'],$cart->conditions['product_id']])}}"><img class="border-radius-5" src="{{$cart->conditions['image']}}" alt="cart-product"></a>
                                    <span class="product__thumbnail--quantity">{{$cart->quantity}}</span>
                                </div>
                                <div class="product__description">
                                    <h3 class="product__description--name h4"><a href="{{route('product.detail',[$cart->conditions['slug'],$cart->conditions['product_id']])}}">{{$cart->name}}</a></h3>
                                    <span class="product__description--variant text-dark">Màu: {{$cart->attributes['color']}}</span> -
                                    <span class="product__description--variant text-dark">Cỡ: {{$cart->attributes['size']}}</span>
                                </div>
                            </div>
                        </td>
                        <td class="cart__table--body__list">
                            <span class="cart__price"><span class="price__product">{{number_format(($cart->price - ($cart->conditions['price_seal'] / 100 * $cart->price))*$cart->quantity)}}</span> <span class="text-danger">VNĐ</span></span>
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
                    <td class="checkout__total--title text-left">Tổng tiền hàng </td>
                    <td class="checkout__total--amount text-right" id="price-product">{{number_format($price)}} <span class="text-danger">VNĐ</span></td>
                </tr>
                @empty(!$voucher)
                <tr class="checkout__total--items">
                    <td class="checkout__total--title text-left">Mã giảm giá</td>
                    <td class="checkout__total--amount text-right" id="price-product">- {{number_format($voucher->price)}} <span class="text-danger">VNĐ</span></td>
                @endempty
                </tr>
                <tr class="checkout__total--items">
                    <td class="checkout__total--title text-left">Tiền vận chuyển</td>
                    <td class="checkout__total--calculated__text text-right">+{{number_format($priceShip)}} <span class="text-danger">VNĐ</span></td>
                </tr>
                </tbody>
                <tfoot class="checkout__total--footer">
                <tr class="checkout__total--footer__items">
                    <td class="checkout__total--footer__title checkout__total--footer__list text-left">Tổng tiền</td>
                    <td class="checkout__total--footer__amount checkout__total--footer__list text-right">
                        <input type="text" id="price-total-product" style="border: none" name="total" value="{{number_format($total)}}" class="text-right" readonly> VNĐ
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </aside>
@endsection
