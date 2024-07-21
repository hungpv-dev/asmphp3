<?php

namespace App\Http\Controllers\API\VietNam;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistrictsController extends Controller
{
    public function index($code){
        
        $listDistricts = DB::connection('api_vietnam')->table('districts')->where('province_code',$code)->get();

        return DistrictsResource::collection($listDistricts);
    }
}
