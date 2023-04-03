<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Todo;

class Category extends Model
{
    use HasFactory;

    public function todos(){
        //Indicar que una categoria puede tener muchos todos
        return $this->hasMany(Todo::class);
    }
}
