<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model
{
    use HasFactory;
    protected $fillable = ['full_name','email_address','phone_number','subject','category_id','message'];
    public function category(){
    	return $this->belongsTo(Category::class)->select('id','category_name');
    }
}
