<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cate_id = $request->input('cate_id');
        $keyword = $request->input('keyword');
        $seal = $request->input('seal');
        $page = $request->input('page');
        $status = $request->input('status') ?? 12;
        $limit = $request->input('limit') ?? 12;
        $offset = ($page-1)*$limit;


        $listProduct = Product::with('images');
        $category = Category::find($cate_id);

        if($category){
            $listProductIds = [];
            $category->listProductIds($cate_id,$listProductIds);
            $listProduct->whereIn('id',$listProductIds);
        }

        if($keyword){
            $listProduct->where('name','like','%'.$keyword.'%');
        }

        if($seal){
            $listProduct->where('price_seal','>=',$seal);
        }

        if($status != 'all'){
            $listProduct->where('status',$status);
        }

        $listProduct->offset($offset)->limit($limit);

        return ProductResource::collection($listProduct->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        if($request->has('status')){
            $product->update([
                'status' => $request->input('status'),
            ]);
            return response()->json(['status' => $product->status]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
