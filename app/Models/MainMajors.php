<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainMajors extends Model
{
    use HasFactory;
    protected $table='main_majors';
    public $fillable=['name'];
    public function navSubMajors(){
        // $majors = Majors::where("main_major_id",$this->id)->get();
        // // dd($majors);
        // return $majors;
        return $this->hasMany(Majors::class, 'main_major_id', 'id');
    }
}
