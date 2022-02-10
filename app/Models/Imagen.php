<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Imagen extends Model
{
    use HasFactory;

    protected $fillable = ['imagen','post_id'];
    
    //de muchos a uno
   public function posts(){
        return $this->belongsTo(Post::class);
    }
}
