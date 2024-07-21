<?php

namespace App\Http\Controllers\API\VietNam;

use App\Http\Controllers\Controller;
use App\Http\Resources\WardsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WardsController extends Controller
{
    public function index($code){
        $listDistricts = DB::connection('api_vietnam')->table('wards')->where('district_code',$code)->get();

        return WardsResource::collection($listDistricts);
    }
}
