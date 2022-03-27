<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Majors extends Model
{
    use HasFactory;
    protected $table= 'majors';
    public $fillable=['name','code','main_major_id'];

    public function head_teachers(){
        return $this->belongsToMany(User::class, 'majors_head_teacher', 'major_id', 'teacher');
    }
    public function subjects(){
        return $this->hasMany(Subject::class, 'major_id');
    }
}
