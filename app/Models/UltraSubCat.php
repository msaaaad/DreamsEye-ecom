<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;

class UltraSubCat extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','sub_category_id','ultra_sub_category_name','slug','publication_status'];
    public function category(){
        return $this->belongsTo(Category::class)->select('id','category_name','slug');
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'sub_category_id')->select('id','subcategory_name','slug');
    }
    public function products(){
        return $this->hasMany(Product::class,'ultra_sub_category_id','id');
    }
}
