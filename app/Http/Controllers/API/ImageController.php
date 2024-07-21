<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class ImageController extends Controller
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
        $product = Product::find($request->idProduct);
        if($product){
            $files = $request->file('files');
            $data = [];
            foreach ($files as $file){
                $fileUpload = Cloudinary::upload($file->getRealPath(),[
                    'folder' => 'images-product'
                ]);
                $url = $fileUpload->getSecurePath();
                $public_id = $fileUpload->getFileName();
                $image = $product->images()->create([
                    'url' => $url,
                    'public_id' => $public_id
                ]);
                $data[] = $image;
            }
            return response()->json([
                'code' => 201,
                'data' => $data
            ],201);
        }
        return response()->json([
            'message' => 'Dữ liệu gửi lên không hợp lệ',
        ],422);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = Image::find($id);
        if($image){
            Cloudinary::destroy($image->public_id);
            $image->delete();
            return [
                'code' => 200,
                'message' => 'Delete success!'
            ];
        }
        return response()->json([
            'message' => 'Dữ liệu gửi lên không hợp lệ',
        ],422);
    }
}
