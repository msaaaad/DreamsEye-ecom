<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = ['member_name','slug','designation','mobile_number','email_address','address','publication_status','facebook_profile','instagram','twitter','profile_picture'];
}
