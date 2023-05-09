<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vendor;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','last_name','slug','publication_status','email_address','phone_number','password','address','profile_picture'];
    public function vendor(){
    	return $this->belongsTo(Vendor::class,'customer_email','id');
    }
    public function company(){
    	return $this->hasMany(Customer::class,'customerId','id')->select('first_name','last_name','id');
    }
    public function order(){
    	return $this->hasMany(Order::class,'customerId','id');
    }

}
