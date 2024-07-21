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
                    <div class="checkout__discount--code">
                        <form class="d-flex form-giftcode">
                            <label>
                                <input required class="checkout__discount--code__input--field border-radius-5 code" placeholder="Nhập mã giảm giá"  type="text">
                            </label>
                            <button class="checkout__discount--code__btn primary__btn border-radius-5" type="submit">Sử dụng</button>
                        </form>
                    </div>
                    <div class="code-gift">
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
                        <span class="breadcrumb__text current">Thông tin nhận hàng</span>
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
            <form action="{{route('order.info')}}" method="POST">
                @csrf
                <div class="checkout__content--step section__contact--information">
                    <div class="section__header checkout__section--header d-flex align-items-center justify-content-between mb-25">
                        <h2 class="section__header--title h3">Thông tin liên lạc</h2>
                    </div>
                    <div class="customer__information">
                        <div class="checkout__email--phone mb-12">
                            <label>
                                <input class="checkout__input--field border-radius-5" name="email" value="{{$user->email}}" placeholder="Email hoặc số điện thoại của bạn"  type="text">
                            </label>
                        </div>
                        <div class="checkout__checkbox">
                            <input class="checkout__checkbox--input" id="check1" disabled checked type="checkbox">
                            <span class="checkout__checkbox--checkmark"></span>
                            <label class="checkout__checkbox--label" for="check1">
                                Email hoặc số điện thoại</label>
                        </div>
                    </div>
                </div>
                <div class="checkout__content--step section__shipping--address">
                    <div class="section__header mb-25">
                        <h3 class="section__header--title">Thông tin người nhận</h3>
                    </div>
                    <div class="section__shipping--address__content">
                        <div class="row">
                            <div class="col-lg-6 mb-12">
                                <div class="checkout__input--list ">
                                    <label>
                                        <input class="checkout__input--field border-radius-5" placeholder="Họ" name="first_name" value="{{$profile->first_name}}" type="text">
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-12">
                                <div class="checkout__input--list">
                                    <label>
                                        <input class="checkout__input--field border-radius-5"  name="last_name" value="{{$profile->last_name}}" placeholder="Tên"  type="text">
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 mb-12">
                                <div class="checkout__input--list">
                                    <label>
                                        <input class="checkout__input--field border-radius-5"  name="address" placeholder="Địa chỉ chi tiết"  value="{{$profile->address}}" type="text">
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" name="province" id="province">
                            <input type="hidden" name="district" id="district">
                            <input type="hidden" name="ward" id="ward">
                            <input type="hidden" id="code-gift" name="gift">
                            <div class="col-12 mb-12 d-flex flex-wrap justify-content-between gap-2">
                                <div class="checkout__input--list checkout__input--select select col">
                                    <label class="checkout__select--label" for="country">Tỉnh/Thành</label>
                                    <select name="tinh" onchange="showDistricts(this,'#huyen','#xa')" class="checkout__input--select__field border-radius-5" id="tinh">
                                        <option value="0">--Chọn tỉnh thành--</option>
                                    </select>
                                </div>
                                <div class="checkout__input--list checkout__input--select select col">
                                    <label class="checkout__select--label" for="country">Quận/Huyện</label>
                                    <select name="huyen" onchange="showWards(this,'#xa')" class="checkout__input--select__field border-radius-5" id="huyen">
                                        <option value="0">--Chọn quận huyện--</option>
                                    </select>
                                </div>
                                <div class="checkout__input--list checkout__input--select select col">
                                    <label class="checkout__select--label" for="country">Thị/Xã</label>
                                    <select name="xa" class="checkout__input--select__field border-radius-5" id="xa">
                                        <option value="0">--Chọn thị xã--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-12">
                                <div class="checkout__input--list">
                                    <label>
                                        <input class="checkout__input--field border-radius-5"  name="tel" value="{{$profile->tel}}" placeholder="Số điện thoại"  type="text">
                                    </label>
                                </div>
                            </div>
                            <div class="cart__note mb-20">
                                <h3 class="cart__note--title">Ghi chú</h3>
                                <p class="cart__note--desc">Thêm hướng dẫn đặt biệt cho người bán...</p>
                                <textarea  name="note" class="cart__note--textarea border-radius-5"></textarea>
                            </div>
                        </div>
                        <div class="checkout__checkbox">
                            <input class="checkout__checkbox--input" name="remember" id="check2" type="checkbox">
                            <span class="checkout__checkbox--checkmark"></span>
                            <label class="checkout__checkbox--label" for="check2">
                                Lưu thông tin này cho lần sau</label>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="price-price-order" name="price">
                <input type="hidden" id="price-total-order" name="total">
                <div class="checkout__content--step__footer d-flex align-items-center">
                    <button class="continue__shipping--btn primary__btn border-radius-5">Tới trang vận chuyển</button>
                    <a class="previous__link--content" href="{{route('cart.show')}}">Quay lại giỏ hàng</a>
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
        <div class="checkout__discount--code">
            <form class="d-flex form-giftcode">
                <label>
                    <input required class="checkout__discount--code__input--field border-radius-5 code" placeholder="Nhập mã giảm giá"  type="text">
                </label>
                <button class="checkout__discount--code__btn primary__btn border-radius-5" type="submit">Sử dụng</button>
            </form>
        </div>
        <div class="code-gift mb-3">
            <div class="border rounded px-2 d-flex justify-content-between">
            </div>
        </div>
        <div class="checkout__total">
            <table class="checkout__total--table">
                <tbody class="checkout__total--body">
                <tr class="checkout__total--items">
                    <td class="checkout__total--title text-left">Tổng tiền hàng </td>
                    <td class="checkout__total--amount text-right" id="price-product"></td>
                </tr>
                <tr class="checkout__total--items">
                    <td class="checkout__total--title text-left">Tiền vận chuyển</td>
                    <td class="checkout__total--calculated__text text-right">Tính toán ở bước tiếp theo</td>
                </tr>
                </tbody>
                <tfoot class="checkout__total--footer">
                <tr class="checkout__total--footer__items">
                    <td class="checkout__total--footer__title checkout__total--footer__list text-left">Tổng tiền</td>
                    <td class="checkout__total--footer__amount checkout__total--footer__list text-right">
                        <input type="text" id="price-total-product" style="border: none" name="total" class="text-right" readonly> VNĐ
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </aside>
@endsection
<!-- End checkout page area -->

@section('script')
    <script>
        $(document).ready(function(){
            getProvinces($("#tinh"),{{$profile->tinh}});
            getDistricts($("#huyen"),{{$profile->tinh}},{{$profile->huyen}});
            getWards($("#xa"),{{$profile->huyen}},{{$profile->xa}});
            totalPriceCart();
            setTimeout(function(){
                setAddress();
            },1000);
        });
        function setAddress(){
            let optionTinh = $('#tinh option:selected').text();
            $("#province").val(optionTinh);
            let optionHuyen = $('#huyen option:selected').text();
            $("#district").val(optionHuyen);
            let optionXa = $('#xa option:selected').text();
            $("#ward").val(optionXa);
        }
        $(document).on('change','#tinh',function(){
            let option = $('#tinh option:selected').text();
            $("#province").val(option);
        });
        $(document).on('change','#huyen',function(){
            let option = $('#huyen option:selected').text();
            $("#district").val(option);
        });
        $(document).on('change','#xa',function(){
            let option = $('#xa option:selected').text();
            $("#ward").val(option);
        });
        function totalPriceCart(){
            let spans = $('.cart__price .price__product');
            let sum = 0;
            for(const span of spans){
                sum += +(span.innerText.replace(/,/g, ''));
            }
            let value = Math.floor(sum).toLocaleString('en-US');
            $("#price-product").text(value+ ' VNĐ');
            $("#price-total-product").val(value);
            $("#total-phone").text(value+ ' VNĐ');
            $("#price-total-order").val(sum);
            $(".phone-price").text(value+ ' VNĐ');
            $("#price-price-order").val(sum);
        }
        $(document).on('input','.code',function(){
            let value = $(this).val().replace(/[^\w\s]/gi, '').replace(/\s/g, '');
            $(this).val(value.toUpperCase());
        })
        $(document).on('submit','.form-giftcode',function(e){
            e.preventDefault();
            let input = $(this).find('.code').val();
            let that = $(this);
            $.ajax({
                url : getUrl('api/giftcodes/'+input),
                method: 'GET',
                success: function(response){
                    if(response.code == 200){
                        let code = response.data;
                        let price = $("#price-total-product").val().replace(/,/g, '');
                        let value = price-code.price;
                        if(parseInt(price) >= code.min_order){
                            if(value < 0){
                                value = 0;
                            }
                            $("#price-total-product").val((value).toLocaleString('en-US'));
                            $("#total-phone").text((value).toLocaleString('en-US')+' VNĐ');
                            $("#price-total-order").val(value);
                            $(".phone-price.two").text((value).toLocaleString('en-US')+' VNĐ');
                        }
                        $('.code-gift').html(`
                        <div class="border rounded px-2 row">
                            <div class="col-6 row">
                                <span class="text-danger col-12">Mã: ${code.code}</span>
                                <span class="col-12">Còn lại: ${code.count}</span>
                            </div>
                            <div class="col-6 row">
                                <span class="col-12">Giảm: ${parseInt(code.price).toLocaleString('en-US')}</span>
                                <span class="col-12">Cho đơn: ${parseInt(code.min_order).toLocaleString('en-US')}</span>
                            </div>
                        </div>
                    `);
                        that.find('.code').val('');
                        $("#code-gift").val(code.id);
                    }
                },error: function(log){
                    if(log.responseJSON.code == 404){
                        swal(log.responseJSON.message,{
                            icon: 'error'
                        });
                        $('.code-gift').html('');
                    }
                }
            })
        });
    </script>
@endsection
