<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Property;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $title = 'Giỏ hàng';
        $carts = \Cart::session(auth()->id())->getContent();
        return view('cart.index',compact('title','carts'));
    }

    public function add(Request $request){
        $product_id = $request->input('product');
        $property_id = $request->input('property');
        $count = $request->input('count');
        if($product_id && $property_id){
            $product = Product::find($product_id);
            $property = Property::find($property_id);
            if($product && $property){
                if($property->status == 0){
                    if($property->count < $count){
                        toast('Số lượng sản phẩm đã được cập nhật','info');
                    }else{
                        $rowId = $product_id.$property_id;
                        $cart = \Cart::session(auth()->id())->get($rowId);
                        if($cart){
                            \Cart::session(auth()->id())->update($rowId,[
                                'price' => $product->price,
                                'quantity' => $count,
                                'conditions' => [
                                    'image' => $product->images[0]->url ?? 'https://tse3.mm.bing.net/th?id=OIP.i6csXaCi4MObhfBOuxqRLgAAAA&pid=Api&P=0&h=220',
                                    'price_seal' => $product->price_seal
                                ],
                            ]);
                        }else{
                            \Cart::session(auth()->id())->add(array(
                                'id' => $rowId,
                                'name' => $product->name,
                                'price' => $product->price,
                                'quantity' => $count,
                                'attributes' => [
                                    'color' => $property->color,
                                    'size' => $property->size,
                                ],
                                'conditions' => [
                                    'image' => $product->images[0]->url ?? 'https://tse3.mm.bing.net/th?id=OIP.i6csXaCi4MObhfBOuxqRLgAAAA&pid=Api&P=0&h=220',
                                    'price_seal' => $product->price_seal,
                                    'slug' => $product->slug,
                                    'product_id' => $product_id
                                ],
                                'associatedModel' => $property_id
                            ));
                        }
                        return redirect(route('cart.show'));
                    }
                }else{
                    toast('Mẫu sản phẩm đã ngưng bán!','warning');
                }
            }else{
                toast('Sản phẩm không tồn tại!','error');
            }
        }
        return back();
    }

    public function clear(){
        \Cart::session(auth()->id())->clear();
        return redirect(route('cart.show'));
    }

    function updateCartId($id,Request $request){
        $cart = \Cart::session(auth()->id())->get($id);
        $property = Property::find($cart->associatedModel);
        $value = $request->input('value');
        $count = 0;
        $message = '';
        if($cart) {
            if ($request->input('phepTinh') == 'up') {
                if ($value > $property->count) {
                    $message = 'Đã đạt giới hạn số lượng trong kho';
                    $count = $property->count;
                } else {
                    \Cart::session(auth()->id())->update($id, [
                        'quantity' => +1
                    ]);
                }
            } else {
                if ($value < 1) {
                    $message = 'Số lượng tối thiểu là 1';
                    $count = 1;
                }else{
                    \Cart::session(auth()->id())->update($id, [
                        'quantity' => -1
                    ]);
                }
            }
        }
        return response()->json([
            'code'  => 200,
            'count' => $cart->quantity,
            'price' => $cart->price - ($cart->conditions['price_seal'] / 100 * $cart->price),
            'value' => $count,
            'message' => $message,
        ],200);
    }

    public function destroy($id){
        \Cart::session(auth()->id())->remove($id);
        return response()->json([
            'id' => $id,
            'code' => '204',
            'message' => 'Xóa sản phẩm thành công'
        ]);
    }
}
