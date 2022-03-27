<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ExcelDetail extends Model
{
    use HasFactory;
    protected $table = 'excel_details';
    public $fillable = ['excel_id','name','subject_code','teacher','score','semester'];
    protected $pirmaryKey='id';
}
