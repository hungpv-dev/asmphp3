<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $data = [];
        $categories = Category::where('parent_id',NULL)->get();
        foreach ($categories as $category){
            $list = [];
            $category->listChildCategories($category->id,$list);
            $category->childCate = $list;
            $data[] = $category;
        }

        return $data;
    }
}
