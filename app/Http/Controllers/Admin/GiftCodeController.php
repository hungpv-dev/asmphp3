<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GiftCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class GiftCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Mã giảm giá';
        $giftcodes = GiftCode::orderBy('id','desc')->get();
        return view('admin.giftcode.index',compact('title','giftcodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm mã giảm giá';
        return view('admin.giftcode.add',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $this->validateGiftCode($request);
        if($validate->fails()){
            Alert::warning('Thông báo','Vui lòng nhập đúng thông tin');
            return back()->withInput();
        }
        $formatPrice = new \NumberFormatter('en_US', \NumberFormatter::DECIMAL);
        $code = $request->input('code');
        $count = $request->input('count');
        $price = $formatPrice->parse($request->input('price'));
        $minOrder = $formatPrice->parse($request->input('min_order'));
        $maxTime = $request->input('max_time');
        $status = $request->input('status');
        GiftCode::create([
            'code' => $code,
            'count' => $count,
            'price' => $price,
            'min_order' => $minOrder,
            'max_time' => $maxTime,
            'status' => $status,
        ]);
        Alert::success('Thông báo','Thêm mã giảm giá thành công');
        return redirect(route('admin.giftcode.index'));
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
     * Show the form for editing the specified resource.
     */
    public function edit(GiftCode $giftCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GiftCode $giftCode)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GiftCode $giftCode)
    {
        //
    }


    public function validateGiftCode($request){
        $rules = [
            'code' => ['required','min:5','max:40'],
            'count' => ['required','numeric'],
            'price' => ['required'],
            'min_order' => ['required'],
            'max_time' => ['required'],
            'status' => ['required','numeric'],
        ];
        $validator = Validator::make($request->all(),$rules);
        return $validator;
    }
}
