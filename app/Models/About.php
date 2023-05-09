<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $fillable = ['about_us','choice_us','slug','address','publication_status','facebook_page','facebook_group','instagram','twitter'];
}
