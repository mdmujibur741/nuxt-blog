<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogImage extends Model
{
    use HasFactory;
    protected $fillable = ['blog_id', 'image'];

    protected $appends = ['src']; 
   
   
    public function getSrcAttribute(){
       if (filter_var($this->image, FILTER_VALIDATE_URL) !== false) {
           return $this->image;
       } else {
          return asset("storage/{$this->image}") ;
       }
      }
   
       public function blog() :BelongsTo
       {
            return $this->belongsTo(Blog::class);
       }
}
