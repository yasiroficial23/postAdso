<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Muestra la lista de posts y el formulario (estilo Dashboard).
     */
    public function index()
    {
        // Traemos los posts con su categoría (Eager Loading) para que sea rápido
        $posts = Post::with('category')->latest()->get();
        
        // Necesitamos las categorías para el menú desplegable del formulario
        $categories = Category::all();

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Guarda un nuevo post.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title); // Genera "mi-post" desde "Mi Post"
        $post->body = $request->body;
        $post->category_id = $request->category_id;

        // Lógica simple para la imagen (si se sube una)
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->save();

        return redirect()->route('admin.posts.index')->with('status', '¡Post creado con éxito!');
    }

    /**
     * Elimina un post.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Post eliminado.');
    }
}