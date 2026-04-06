<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'image',
        'category_id',
        'is_published',
    ];

    // Relación inversa: Un post pertenece a una categoría
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}