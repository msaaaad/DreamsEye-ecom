<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['company_name','slug','bill_address','tin_certificate','varification','customerId','emergency_contact','seller_status'];
    public function customer(){
    	return $this->belongsTo(Customer::class,'customerId','id');
    }
}
