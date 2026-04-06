<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            
            // Título y Slug (para URLs amigables como /post/mi-primera-noticia)
            $table->string('title');
            $table->string('slug')->unique();
            
            // Contenido del post (usamos text para que sea largo)
            $table->text('body');
            
            // Imagen de portada (opcional)
            $table->string('image')->nullable();

            // RELACIÓN: Aquí conectamos el post con una categoría
            // constrained() asegura que la categoría exista en la tabla 'categories'
            // onDelete('cascade') borra los posts si borras la categoría (opcional)
            $table->foreignId('category_id')->constrained()->onDelete('cascade');

            // Estado del post (Borrador o Publicado)
            $table->boolean('is_published')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};