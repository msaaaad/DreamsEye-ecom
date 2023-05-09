<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category_name','slug','category_image','publication_status'];

    public function products(){
    	return $this->hasMany(Product::class,'category_id','id');
    }
    public function models(){
    	return $this->hasMany(Actor::class,'category_id','id');
    }
    public function subcategory(){
    	return $this->hasMany(SubCategory::class,'category_id','id');
    }
    public function supersubcategory(){
        return $this->hasMany(UltraSubCat::class,'sub_category_id','id');
    }
    public function CustomerContact(){
        return $this->hasMany(CustomerContact::class,'category_id','id');
    }
    public function cart(){
        return $this->hasMany(Cart::class,'category_id','id');
    }
}
