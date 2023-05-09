<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function getCreateDateAttribute(){
        return $this->created_at->diffForHumans();
    }
    public function customer(){
    	return $this->belongsTo(Customer::class)->select('*');
    }
}
