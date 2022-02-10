<?php

namespace App\Models;

use App\Models\Imagen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['titulo','cover'];
    //uno a muchos
    public function imagens(){
        return $this->hasMany(Imagen::class);
    }

}
