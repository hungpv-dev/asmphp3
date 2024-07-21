<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $title = 'Sản phẩm';
        $categories = Category::where('parent_id',NULL)->get();
        $products = Product::limit(12)->get();
        return view('admin.product.index',compact('title','categories','products'));
    }

    public function show($slug,$id){
        $title = 'Chi tiết sản phẩm';
        $product = Product::find($id);
        return view('admin.product.show',compact('title','product'));
    }

    public function create(){
        $title = 'Thêm sản phẩm';
        return view('admin.product.create',compact('title'));
    }

    public function store(ProductRequest $request){
        $roles = [
            'color' => ['required','min:1','max:30'],
            'size' => ['required','min:1','max:20'],
            'count' => ['required','numeric'],
        ];

        $request->validate($roles);

        $files = $request->file('images');
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'price_seal' => $request->price_seal,
            'desc_short' => $request->desc_short,
            'desc' => $request->desc,
        ];
        $product = Product::create($data);
        $dataProperty = [
            'product_id' => $product->id,
            'color' => $request->color,
            'size' => $request->size,
            'count' => $request->count
        ];
        Property::create($dataProperty);
        foreach ($files as $file){
            $upload = Cloudinary::upload($file->getRealPath(),[
                'folder' => 'images-product'
            ]);
            $url = $upload->getSecurePath();
            $public_id = $upload->getFileName();
            $product->images()->create([
                'url' => $url,
                'public_id' => $public_id
            ]);
        }
        toast('Thêm sản phẩm thành công!','success');
        return redirect(route('admin.products.home'));
    }


    public function update(ProductRequest $request){
        $product = Product::find($request->id);
        if($product){
            $data = [
                'name' => $request->name,
                'slug' => $request->slug,
                'price' => $request->price,
                'price_seal' => $request->price_seal,
                'desc_short' => $request->desc_short,
                'desc' => $request->desc,
            ];
            $product->update($data);
            toast('Cập nhật thành công!','success');
        }else{
            toast('Cập nhật thất bại!','error');
        }
        return back();
    }


    public function categories($id){
        $title = 'Danh mục sản phẩm';
        $product = Product::find($id);
        return view('admin.product.categories',compact('title','product'));
    }

    public function storeCategories(Request $request){
        $filteredValues = array_filter($request->all(), function($key) {
            return strpos($key, 'cate') !== false;
        }, ARRAY_FILTER_USE_KEY);
        $data = array_values($filteredValues);
        $product = Product::find($request->idProduct);
        $product->categories()->sync($data);
        toast('Cập nhật danh mục thành công','success');
        return back();
    }

}
