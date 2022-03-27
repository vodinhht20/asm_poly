<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class MajorsHeadTeacher extends Model
{
    use HasFactory,HasRoles;
    protected $table='majors_head_teacher';
    public $fillable = ['major_id','campus_id','teacher'];
    protected $pirmaryKey='id';
    protected $guard_name = 'web';

    public function major_obj(){
        return $this->belongsTo(Majors::class,'major_id','id');

    }
}
