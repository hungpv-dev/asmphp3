<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $title = 'Quản lý đơn hàng';
        $orders = Order::with('user','trangThai')->orderBy('created_at','desc')->get();
        return view('admin.order.index',compact('title','orders'));
    }

    public function detail($id){
        $title = 'Chi tiết đơn hàng';
        $order = Order::find($id);
        if(!$order){
            return redirect(route('admin.order.home'));
        }
        $status = OrderStatus::all();
        return view('admin.order.detail',compact('title','order','status'));
    }

    public function update($id, Request $request){
        $order = Order::find($id);
        if(!$order){
            return redirect(route('home'));
        }else if($order->status == 6){
            toast('Đơn hàng này đã bị hủy','error');
        }else if($order->status == 5){
            toast('Đơn hàng này đã hoàn thành','error');
        }else{
            $order->update([
                'status' => $request->status,
            ]);
            toast('Cập nhật thành công','success');
        }
        return back();
    }
}
