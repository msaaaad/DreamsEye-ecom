<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = ['customer_email','publication_status'];
    public function customer(){
    	return $this->belongsTo(Customer::class)->select('id','first_name','last_name','email_address','phone_number','address');
    }
    

}
