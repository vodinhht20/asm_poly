<?php

namespace App\Exports;

use App\Models\Excel_detail;
use Maatwebsite\Excel\Concerns\FromCollection;

class Export implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Excel_detail::all();
    }
}
