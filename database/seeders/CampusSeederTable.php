<?php

namespace Database\Seeders;

use App\Models\Campus;
use Illuminate\Database\Seeder;

class CampusSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campusList = [
            ['name' => 'Toàn quốc'],
            ['name' => 'Hà Nội'],
            ['name' => 'Đà Nẵng'],
            ['name' => 'Tây Nguyên'],
            ['name' => 'Hồ Chí Minh'],
            ['name' => 'Cần Thơ'],
        ];
        foreach($campusList as $cp){
            $model = new Campus();
            $model->name = $cp['name'];
            $model->save();
        }
    }
}
