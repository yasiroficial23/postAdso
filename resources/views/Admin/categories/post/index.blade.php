<x-layouts::app :title="__('Inicio')">
    <div class="max-w-7xl mx-auto p-6 lg:p-10">
        <div class="text-center mb-16 py-10">
            <h1 class="text-5xl font-black text-zinc-900 dark:text-white tracking-tighter mb-4 italic">
                Mi Blog de Contenido
            </h1>
            <p class="text-zinc-500 text-lg max-w-2xl mx-auto">
                Explora las últimas noticias, tutoriales y artículos sobre tecnología y diseño.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <article class="group bg-white dark:bg-zinc-900 rounded-[2.5rem] border border-zinc-200 dark:border-zinc-800 overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="aspect-video overflow-hidden bg-zinc-100 relative">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-zinc-300">
                                <flux:icon name="photo" class="size-12" />
                            </div>
                        @endif
                        <span class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur-md rounded-full text-[10px] font-black uppercase tracking-widest text-indigo-600 shadow-sm">
                            {{ $post->category->name }}
                        </span>
                    </div>

                    <div class="p-8">
                        <div class="text-xs text-zinc-400 font-bold mb-3 uppercase tracking-tighter">
                            {{ $post->created_at->format('M d, Y') }} — {{ $post->created_at->diffForHumans() }}
                        </div>
                        <h2 class="text-2xl font-black text-zinc-900 dark:text-white mb-4 leading-tight group-hover:text-indigo-600 transition-colors italic">
                            {{ $post->title }}
                        </h2>
                        <p class="text-zinc-500 line-clamp-3 text-sm leading-relaxed mb-6">
                            {{ Str::limit($post->body, 120) }}
                        </p>
                        
                        <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center gap-2 text-sm font-black text-zinc-900 dark:text-white hover:text-indigo-600 transition-colors group/link">
                            Leer artículo completo
                            <flux:icon name="arrow-right" variant="mini" class="size-4 group-hover/link:translate-x-1 transition-transform" />
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-zinc-400 font-bold italic">No hay publicaciones disponibles por el momento.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts::app>