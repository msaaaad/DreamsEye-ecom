<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Category;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','customer_id','product_color','product_quantity','product_image','product_name','product_price'];
    public function product(){
    	return $this->belongsTo(Product::class)->select('id','product_name','product_price_regular','product_price_discount','product_color','product_quantity','category_id','product_image','inside_dhaka','outside_dhaka');
    }
    public function category(){
    	return $this->belongsTo(Category::class)->select('id','category_name','slug');
    }
}
