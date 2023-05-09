<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','model_image','publication_status','banner_status'];
    public function category(){
    	return $this->belongsTo(Category::class)->select('id','category_name');
    }
}
