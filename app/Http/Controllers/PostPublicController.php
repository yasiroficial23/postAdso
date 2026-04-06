<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostPublicController extends Controller
{
    public function index()
    {
        // Solo mostramos posts publicados y cargamos su categoría
        $posts = Post::with('category')
            ->where('is_published', true) // Asegúrate de marcar algunos como publicados en la BD
            ->latest()
            ->get();

        return view('welcome', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}