<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Category;
use App\Models\UltraSubCat;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','subcategory_name','slug','publication_status'];
    public function products(){
    	return $this->hasMany(Product::class,'subcategory_id','id');
    }
    public function supersubcategory(){
    	return $this->hasMany(UltraSubCat::class,'sub_category_id','id');
    }
    public function category(){
    	return $this->belongsTo(Category::class)->select('id','category_name');
    }
}
