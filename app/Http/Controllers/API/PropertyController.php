<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Webmozart\Assert\Tests\StaticAnalysis\email;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $idProduct = $request->input('idProduct');
        if($idProduct){
            $product = Property::where('product_id',$idProduct)->get();
            return response()->json($product,201);
        }
        return response()->json([
            'message' => 'Dữ liệu gửi lên không hợp lệ',
        ],422);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = $request->input('idProduct');
        $color = $request->input('color');
        $size = $request->input('size');
        $count = $request->input('count');
        if($id){
            $errors = $this->validateProperty($request);
            if(!empty($errors)){
                return response()->json(['errors' => $errors], 422);
            }
            $property = Property::where('product_id',$id)->where('color',$color)->where('size',$size)->first();
            if($property){
                return response()->json([
                    'code' => 400,
                    'message' => 'Bản ghi đã tồn tại'
                ]);
            }
            $property = Property::create([
                'product_id' => $id,
                'color' => $color,
                'size' => $size,
                'count' => $count,
            ]);
            return response()->json([
                'code' => 201,
                'data' => $property
            ],201);
        }
        return response()->json([
            'message' => 'Dữ liệu gửi lên không hợp lệ',
        ],422);
    }
    public function validateProperty($request){
        $errors = [];
        $roles = [
            'color' => ['required','min:1','max:30'],
            'size' => ['required','min:1','max:20'],
            'count' => ['required','numeric'],
        ];
        $messages = [
            'required' => ':attribute bắt buộc nhập!',
            'min' => ':attribute tối thiểu :min kí tự',
            'max' => ':attribute tối đa :max kí tự',
            'numeric' => ':attribute phải là số',
        ];
        $validate = Validator::make($request->all(),$roles,$messages);
        if($validate->fails()){
            $errors = $validate->errors()->all();
        }
        return $errors;
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
    public function update(Request $request, Property $property)
    {
        $property->update([
            $request->type => $request->text
        ]);
        return response()->json([
            'data' => $property,
            'code' => 200
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return response()->json([
            'code' => 204,
            'message' => 'Delete success!'
        ]);
    }
}
