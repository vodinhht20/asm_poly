<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;
    protected $table = 'campus';

    public function getHeadTeacherByMajor($majorId){
        return User::select(
                    'users.id', 'users.email', 
                )
                ->leftJoin('majors_head_teacher', 'users.id', '=', 'majors_head_teacher.teacher')
                ->where('majors_head_teacher.major_id', $majorId)
                ->where('majors_head_teacher.campus_id', $this->id)
                ->first();
    }
}
