<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelImport extends Model
{
    use HasFactory;
    protected $table = 'excel_imports';
    public $fillable=['created_by','campus_id'];
}
