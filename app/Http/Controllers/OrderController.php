<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Payment\VnPayController;
use App\Models\FeeShip;
use App\Models\GiftCode;
use App\Models\Order;
use App\Models\User;
use App\Models\VnPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function info(){
        $title = 'Mua hàng';
        $userId = auth()->id();
        $user = User::find($userId);
        $profile = $user->profile;
        if(!$profile){
            $profile = new class{
                public $first_name = '';
                public $last_name = '';
                public $tel = '';
                public $address = '';
                public $xa = 0;
                public $huyen = 0;
                public $tinh = 0;
            };
        }
        $carts = \Cart::session($userId)->getContent();
        return view('order.info',compact('title','user','profile','carts'));
    }

    public function saveInfo(Request $request){
        $user = User::find(auth()->id());
        if(!$user){
            Alert::error('Thông báo','Lỗi xác thực người dùng, vui lòng đăng nhập lại!');
            return back();
        }
        if($request->has('remember')){
            $profile = $user->profile;
            $dataUser = [
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "tel" => $request->tel,
                "address" => $request->address,
                "xa" => $request->xa,
                "huyen" => $request->huyen,
                "tinh" => $request->tinh,
            ];
            if($profile){
                $profile->update($dataUser);
            }else{
                $user->profile()->create($dataUser);
            }
        }

        $feeship = FeeShip::where('province',$request->province)->where('district',$request->district)->where('ward',$request->ward)->first();
        if($feeship){
            $priceShip = $feeship->price;
        }else{
            $priceShip = 30000;
        }
        $voucher = '';
        $gift = $request->gift;
        if(!$gift){
            $gift = NULL;
            $total = $request->price+$priceShip;
        }else{
            $total = $request->total+$priceShip;
            $voucher = GiftCode::find($gift);
            if($request->price < $voucher->min_order){
                $voucher = '';
            }
        }
        $title = 'Thông tin vận chuyển';
        $carts = \Cart::session(Auth::id())->getContent();
        $fullname = $request->first_name . ' ' . $request->last_name;
        $address = $request->address . ', '.$request->ward . ', '.$request->district . ', '.$request->province;
        $tel = $request->tel;
        $price = $request->price;
        $note = $request->note;
        return view('order.shipping',compact('title','note','carts','total','fullname','voucher','address','tel','priceShip','price'));

    }

    public function saveOrder(Request $request){
        $payment = $request->payment;
        $gift = $request->voucher;
        if(!$gift){
            $gift = 0;
        }
        $carts = \Cart::session(Auth::id())->getContent();
        $data = [
           'user_id' => Auth::id(),
           'full_name' => $request->fullname,
           'tel' => $request->tel,
           'address' => $request->address,
           'price' => $request->price,
           'count' => $carts->sum('quantity'),
           'payment' => $payment,
           'gift_code' =>  $gift,
           'status' => 1,
           'ship' => $request->ship,
           'note' => $request->note ?? '',
        ];
        $order = Order::create($data);
        foreach($carts as $cart){
            $order->products()->create([
                'product_id' => $cart->conditions['product_id'],
                'name' => $cart->name,
                'image' => $cart->conditions['image'],
                'count' => $cart->quantity,
                'size' => $cart->attributes['size'],
                'color' => $cart->attributes['color'],
                'price' => ($cart->price - ($cart->conditions['price_seal'] / 100 * $cart->price))*$cart->quantity,
                'slug' => $cart->conditions['slug'],
            ]);
        }

        $this->cartClear();

        switch ($payment){
            case 'COD' : {
                toast('Đặt hàng thành công','success');
                return redirect(route('account.show'));
                break;
            }
            case 'VNPAY' : {
                (new VnPayController)->create($order->id,$request->price);
                break;
            }
            default: {
                break;
            }
        }
    }


    public function cartClear(){
        \Cart::session(auth()->id())->clear();
    }
    public function infoOrder(Request $request)
    {
        $order = Order::find($request->vnp_TxnRef);
        if($order){
            if($request->has('vnp_BankTranNo')){
                $data = [
                  'bill_id' => $order->id,
                  'vnp_amount' => $request->vnp_Amount,
                  'vnp_bankCode' => $request->vnp_BankCode,
                  'vnp_banktranno' => $request->vnp_BankTranNo,
                  'vnp_cardtype' => $request->vnp_CardType,
                  'vnp_orderinfo' => $request->vnp_OrderInfo,
                  'vnp_paydate' => $request->vnp_PayDate,
                  'vnp_tmncode' => $request->vnp_TmnCode,
                  'vnp_transactionno' => $request->vnp_TransactionNo,
                ];
                VnPay::create($data);
            }else{
                Alert::error('Thông báo','Thanh toán không thành công');
            }
            return redirect(route('account.show'));
        }else{
            return redirect(route('home'));
        }
    }
    public function show($id){
        $title = 'Thông tin đơn hàng';
        $order = Order::find($id);
        if(!$order || auth()->id() !== $order->user_id){
            toast('Bạn không đủ quyền xem thông tin đơn hàng này','warning');
            return redirect(route('home'));
        }
        return view('order.order',compact('title','order'));
    }
}
