<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FeeShip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeeShipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listFeeShip = FeeShip::query();
        if($request->has('province')){
            $listFeeShip->where('province',$request->input('province'));
        }
        if($request->has('district')){
            $listFeeShip->where('district',$request->input('district'));
        }
        return response()->json([
            'data' => $listFeeShip->get(),
            'code' => 200,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $this->validateFeeShip($request);
        if($validate->fails()){
            return response()->json([
                'code' => 404,
                'message' => 'Dữ liệu gửi lên không hợp lệ'
            ]);
        }
        $province = $request->input('province');
        $district = $request->input('district');
        $ward = $request->input('ward');
        $price = $request->input('price');
        $feeship = $this->getFindFeeShip($province,$district,$ward);
        $data = [
            'province' => $province,
            'district' => $district,
            'ward' => $ward,
            'price' => $price
        ];
        if($feeship){
            $feeship->update($data);
            $message = 'Cập nhật thành công';
        }else{
            $feeship = FeeShip::create($data);
            $message = 'Thêm thành công';
        }
        return response()->json([
            'code' => 201,
            'message' => $message,
            'data' => $feeship
        ]);
    }

    public function validateFeeShip($request){
        $rules = [
             'province' => ['required'],
             'district' => ['required'],
             'ward' => ['required'],
             'price' => ['required','regex:/^\d+(\.\d{1,2})?$/'],
        ];
        $validate = Validator::make($request->all(),$rules);
        return $validate;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feeship = FeeShip::find($id);
        if($feeship){
            return response()->json([
                'code' => 200,
                'data' => $feeship
            ]);
        }
        return response()->json([
            'code' => 404,
            'message' => 'Bản ghi không tồn tại'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $this->validateFeeShip($request);
        if($validate->fails()){
            return response()->json([
                'code' => 404,
                'message' => 'Dữ liệu gửi lên không hợp lệ'
            ]);
        }
        $province = $request->input('provinces');
        $district = $request->input('district');
        $ward = $request->input('ward');
        $price = $request->input('price');
        $feeship = FeeShip::find($id);
        if($feeship){
            $feeship->update([
                'province' => $province,
                'district' => $district,
                'ward' => $ward,
                'price' => $price
            ]);
        }
        return response()->json([
            'code' => 404,
            'message' => 'Bản ghi không tồn tại'
        ]);
    }

    private function getFindFeeShip($province,$district,$ward){
        $feeship = FeeShip::where('province',$province)->where('district',$district)->where('ward',$ward)->first();
        return $feeship;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feeship = FeeShip::find($id);
        $feeship->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Xóa bản ghi thành công!'
        ]);
    }
}
