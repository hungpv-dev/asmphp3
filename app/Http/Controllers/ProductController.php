<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request){
        $title = 'Danh sách sản phẩm';

        $keyword = $request->input('keyword');
        $seal = $request->input('seal');
        $minPrice = $request->input('min');
        $maxPrice = $request->input('max');
        $categoryId = $request->input('category');
        $page = $request->input('page') ?? 1;
        $showing = (($page-1) * 16) + 1;

        $categories = (new CategoryController)->index();
        $products = Product::with(['images','categories'])->where('status',0);

        if($categoryId && !empty($categoryId)){
            $category = Category::find($categoryId);
            if($category){
                $listIdProduct = [];
                $category->listProductIds($categoryId,$listIdProduct);
                $products->whereIn('id',$listIdProduct);
            }
        }
        if($keyword && !empty($keyword)){
            $products->where('name','like','%'.$keyword.'%');
        }
        if($seal && !empty($seal)){
            $products->where('price_seal','>=',$seal);
        }
        if($minPrice && !empty($minPrice)){
            $products->where('price','>=',$minPrice);
        }
        if($maxPrice && !empty($maxPrice)){
            $products->where('price','<=',$maxPrice);
        }

        $countProducts = $products->count();

        $products = $products->paginate(16);

        return view('product.index',compact('title','categories','seal','products','keyword','countProducts','showing'));
    }

    public function detail($slug,$id,Request $request){
        $title = "Chi tiết sản phẩm";
        $product = Product::with('images','comments')->find($id);
        $colors = Property::select('color',\DB::raw('COUNT(*) as count'))->where('product_id',$id)->groupBy('color');
        $sizes = Property::select('size',\DB::raw('COUNT(*) as count'))->where('product_id',$id)->groupBy('size');
        $color = $request->input('color') ?? '';
        $size = $request->input('size') ?? '';
        $thuocTinh = '';
        if($color){
            $sizes->where('color',$color);
        }
        if($size){
            $colors->where('size',$size);
        }
        if($color && $size){
            $thuocTinh = Property::where('product_id',$id)->where('color',$color)->where('size',$size)->first();
        }
        $sizes = $sizes->get();
        $colors = $colors->get();
        $url = $request->url();

        $check = false;
        if(Auth::check()){
            $comment = Auth::user()->comments->where('product_id',$id)->first();
            $orders = Auth::user()->orders;
            if(!$comment && $orders){
                foreach ($orders as $order) {
                    if ($order->status == 5) {
                        foreach ($order->products as $pr) {
                            if ($pr->product_id == $id) {
                                $check = true;
                            }
                        }
                    }
                }
            }
        }
        $averageRating = $product->comments->avg('reating');
        return view('product.detail',compact('title','product','color','size','colors','sizes','thuocTinh','url','check','averageRating'));
    }
}
