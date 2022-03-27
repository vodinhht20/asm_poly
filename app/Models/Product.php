<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'url_video',
        'type_id',
        'descript_short',
        'descript_detail',
    ];
    public function semester_obj(){
        return $this->hasOne(Semester::class,'id','semester');
    }
    public function subject_obj(){
        return $this->hasOne(Subject::class,'code','code_subject');
    }
    public function create_by_obj(){
        return $this->hasOne(User::class,'id','create_by');
    }
    public function user_product(){
        return $this->belongsTo(User::class, 'create_by', 'id');
    }

    public function product_gallery(){
        return $this->hasMany(ProductGallery::class, 'product_id', 'id');
    }

    public function product_type(){
        return $this->belongsTo(ProductType::class, 'type_id', 'id');
    }
    public function member_obj(){
        return $this->hasMany(Member::class, 'product_id', 'id');
    }
    public function star_obj() {
        return $this->hasMany(Star::class, 'product_id', 'id');
    }

    public function comment_obj() {
        return $this->hasMany(Comment::class, 'product_id', 'id')->orderByDesc('created_at');
    }
    public function avgStar(){
        $avg = $this->select("products.*", DB::raw("AVG(stars.point) as total_star"))
                ->leftJoin('stars', 'stars.product_id', '=', 'products.id')
                ->where('stars.created_at', '>', Carbon::now()->sub('1 month')->format("Y-m-d"))
                ->where('products.status', 5)
                ->where("product_id",$this->id)
                ->groupBy('stars.product_id', 'products.id')
                ->first();
        return $avg ? $avg->total_star: 0;
    }
    public function avgStarTotal($product_id){
        return Star::where("product_id",$product_id)->avg("point");
    }
}
