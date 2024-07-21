<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->has('parent_id')){
            $parent = $request->parent_id == 'null' ? NULL : $request->parent_id ;
        }else{
            $parent = NULL;
        }
        if($request->has('page') && $request->page == 'null'){
            $categories = Category::where('parent_id',NULL)->get();
        }else{
            $categories = Category::where('parent_id',$parent)->paginate(5);
        }

        if($request->has('keywords')){
            $keywords = $request->input('keywords');
            $categories = Category::where('name','like','%'.$keywords.'%')->paginate(5);
        }
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required','max:40'],
        ],['required'=>'Vui lòng nhập dữ liệu!','max'=>'Không quá 40 kí tự!']);
        $parent_id = $request->input('parent_id') == 'null' ? NULL : $request->input('parent_id');
        Category::create([
           'name' => $request->input('name'),
           'parent_id' => $parent_id,
        ]);
        return response()->json(true,200);
    }

    public function show($id){
        $category = Category::find($id);
        return response()->json($category,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if($request->has('status')){
            $title = '';
            if($request->input('status') == 0){
                $title = 'Hiện';
                $status = 1;
            }else{
                $title = 'Ẩn';
                $status = 0;
            }

            $category->update([
                'status' => $status
            ]);

            return response()->json([
                'id' => $id,
                'title' => $title,
                'status' => $status
            ],200);
        }
        if($request->has('text')){
            $request->validate([
                'text' => ['required','max:40'],
            ],['required'=>'Vui lòng nhập dữ liệu!','max'=>'Không quá 40 kí tự!']);
            $category->update([
                'name' => $request->input('text')
            ]);
            return response()->json([
                'title' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if($category->childCategories->isEmpty()){
            $category->delete();
        }
        return response()->json($category->childCategories);
    }

}
