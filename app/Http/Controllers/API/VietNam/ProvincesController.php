<?php

namespace App\Http\Controllers\API\VietNam;

use App\Http\Controllers\Controller;
use App\Http\Resources\{
    ProvincesResource,
    DistrictsResource
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvincesController extends Controller
{
    public function index(){
        $listProvinces = DB::connection('api_vietnam')->table('provinces')->get();
        return ProvincesResource::collection($listProvinces);
//        return $listProvinces;
    }

    public function getProvinces($code){

        $listProvinces = DB::connection('api_vietnam')->table('provinces')->where('code',$code)->get();

        return ProvincesResource::collection($listProvinces);
    }

}
