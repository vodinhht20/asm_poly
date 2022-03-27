<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Moddel\ProductType;
use App\Models\ProductType as ModelsProductType;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ProductTypeList=[
            ['name'=>'Website'],
            ['name'=>'Mobile'],
            ['name'=>'Phim'],
        ];
       
        foreach($ProductTypeList as $item){
            $ProductType=new ModelsProductType();
            $ProductType->name=$item['name'];
            $ProductType->save();
        }
    }
}
