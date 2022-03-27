<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    public function user_product(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function star_obj($user_id) {
        $star = Star::where([['product_id',$this->product_id],['user_id',$user_id]])->first();
        return $star;
    }

}
