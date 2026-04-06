<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Esto permite que Laravel guarde estos datos en la BD
    protected $fillable = ['name', 'slug']; 
}