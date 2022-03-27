<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Semester;
class SemesterSeedTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $semesterList=[
            ['name'=>'Spring'],
            ['name'=>'Summer'],
            ['name'=>'Fall'],
        ];
       
        foreach($semesterList as $item){
            $semester=new Semester();
            $semester->name=$item['name'];
            $semester->save();
        }
    }
}
