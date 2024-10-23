<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug','subtitle', 'details','image', 'priority', 'meta_title',
    'meta_description',
    'is_popular',
    'is_home_show',
    'status',];
}
