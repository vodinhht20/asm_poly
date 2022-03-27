<?php

namespace App\Imports;

use App\Models\Excel_detail;
use App\Models\Excelimport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use PhpParser\ErrorHandler\Collecting;

class Import implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $row)
    {
        foreach($row as $row){
            $excel_detail=Excel_detail::create([
                'name'=>$row[0],
                'subject_id'=>$row[1],
                'teacher_id'=>$row[2],
                'score'=>$row[3],
            ]);
            $excel_detail->excelimport()->create([
                'excel_id'=>$row['id']
            ]);
        }
        
    }
    
}
