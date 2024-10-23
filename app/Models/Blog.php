<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'slug', 'description', 'priority', 'category_id', 'is_home_show', 'meta_title', 'meta_description', 'is_popular', 'status'];

    public function blogImage() : HasMany
    {
        return $this->hasMany(BlogImage::class);
    }
}
