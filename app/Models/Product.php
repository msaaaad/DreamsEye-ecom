<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Cart;
use App\Models\UltraSubCat;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','subcategory_id','ultra_sub_category_id','product_name','product_color','user_name','slug','product_price_regular','product_price_discount','product_quantity','short_description','long_description','product_image','publication_status','inside_dhaka','outside_dhaka','special_offer'];

    public function category(){
    	return $this->belongsTo(Category::class)->select('id','category_name','slug');
    }

    public function subcategory(){
    	return $this->belongsTo(SubCategory::class)->select('id','subcategory_name','slug');
    }
    public function ultrasubcategory(){
        return $this->belongsTo(UltraSubCat::class,'ultra_sub_category_id','id')->select('id','ultra_sub_category_name','slug');
    }
    public function cart(){
    	return $this->belongsTo(Cart::class)->select('id','product_color','product_quantity','product_id');
    }
}
