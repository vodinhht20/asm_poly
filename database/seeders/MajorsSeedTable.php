<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Majors;
class MajorsSeedTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MajorList=[
            ['major_name' => 'Công Nghệ Thông Tin','major_code' => 'CNTT'],
            ['major_name' => 'Kinh Tế','major_code' => 'KT'],
            ['major_name' => 'Du Lịch-Nhà Hàng-Khách Sạn','major_code' => 'DL'],
            ['major_name' => 'Cơ Khí,Tự Động Hóa','major_code' => 'CK'],
            
        ];
       
        foreach($MajorList as $item){
            $major=new Majors();
            $major->major_name=$item['major_name'];
            $major->major_code=$item['major_code'];
            $major->save();
        }
    }
}
