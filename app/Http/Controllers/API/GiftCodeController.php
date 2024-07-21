<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\GiftCode;
use Illuminate\Http\Request;

class GiftCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($code)
    {
        $giftCode = GiftCode::where('code',$code)->first();
        if($giftCode){
            $message = '';
            $code = 200;
            if(now() > $giftCode->max_time){
                $message = 'Mã giảm giá đã hết hạn';
                $code = 404;
            }else if($giftCode->status == 1){
                $message = 'Mã giảm giá đã ngừng hoạt động!';
                $code = 404;
            }else if($giftCode->count <= 0 ){
                $message = 'Mã giảm giá đã hết!';
                $code = 404;
            }

            return response()->json([
                'code' => $code,
                'data' => $giftCode,
                'message' => $message
            ],$code);
        }
        return response()->json([
            'code' => 404,
            'message' => 'Mã giảm giá không tồn tại',
        ],404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
