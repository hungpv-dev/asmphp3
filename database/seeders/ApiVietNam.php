<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApiVietNam extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listFiles = [
            'create_tables.sql',
            'insert_tables.sql',
            'wards1.sql',
            'wards2.sql',
            'wards3.sql',
            'wards4.sql',
        ];

        foreach ($listFiles as $path_name){
            $filePath = storage_path('database/vietnam/'.$path_name);
            if(file_exists($filePath)){
                $file = file_get_contents($filePath);
                DB::connection('api_vietnam')->unprepared($file);
            }
        }
    }
}
