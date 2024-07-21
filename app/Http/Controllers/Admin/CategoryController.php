<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.category.index');
    }

    public function list($id){

        $parent = $id == 0 ? NULL : $id;
        $listCategory = Category::where('parent_id',$parent)->get();
        if($id != 0){
            $category = Category::find($id);
            $listCategory->prepend($category);
        }
        foreach ($listCategory as $cate){
            $count = 0;
            $cate->countProducts($cate->id,$count);
            $cate->countProduct = $count;
        }
        return response()->json([
            'data' => $listCategory,
            'parent' => $parent
        ]);
    }
}
