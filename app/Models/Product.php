<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','brand_id','product_name','product_price','product_quantity','short_description','long_description','product_image','publication_status'];

    public function category(){
    	return $this->belongsTo(Category::class)->select('id','category_name','slug');
    }
    public function brand(){
    	return $this->belongsTo(Brand::class)->select('id','category_name','slug');
    }
}
