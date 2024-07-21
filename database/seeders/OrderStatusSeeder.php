<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('order_status')->insert([
            ['id' => 1, 'desc' => 'Đã xác nhận'],
            ['id' => 2, 'desc' => 'Đã đóng hàng'],
            ['id' => 3, 'desc' => 'Đang vận huyển'],
            ['id' => 4, 'desc' => 'Đang giao'],
            ['id' => 5, 'desc' => 'Đã nhận hàng'],
            ['id' => 6, 'desc' => 'Đã hủy'],
        ]);
    }
}
