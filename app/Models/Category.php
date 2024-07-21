<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    public $timestamps = false;
    public $fillable = [
        'name',
        'parent_id',
        'status'
    ];

    public function childCategories(){
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function listChildCategories($id, &$list = []){
        $category = Category::with('childCategories')->find($id);
        if(empty($list)){
            $list = array_merge($list,$category->childCategories->toArray());
        }
        if($category->childCategories){
            foreach ($category->childCategories as $cate){
                $list = array_merge($list,$cate->childCategories->toArray());
                $this->listChildCategories($cate->id,$list);
            }
        }
    }

    public function countProducts($id,&$count = 0,&$listProIds = []){
        $cate = Category::find($id);
        if($count == 0){
            $listProIds = array_merge($listProIds,$cate->products->pluck('id')->toArray());
            $count += $cate->products->count();
        }
        $listCate = Category::where('parent_id',$id)->get();
        foreach ($listCate as $category){
            if($category->products){
                $count += $category->products->whereNotIn('id',$listProIds)->count();
                $listProIds = array_merge($listProIds,$category->products->pluck('id')->toArray());
            }
            $this->countProducts($category->id,$count,$listProIds);
        }
    }

    public function listProductIds($cate_id,&$list = []){
        $cate = Category::find($cate_id);
        if(empty($list)){
            $list = array_merge($list,$cate->products->pluck('id')->toArray());
        }
        $listCate = Category::where('parent_id',$cate_id)->get();
        foreach ($listCate as $category){
            if($category->products){
                $list = array_merge($list,$category->products->pluck('id')->toArray());
            }
            $this->listProductIds($category->id,$list);
        }
    }
}
