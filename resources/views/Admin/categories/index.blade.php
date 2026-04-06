<x-layouts::app :title="__('Categorías')">
    <div class="max-w-6xl mx-auto p-6 lg:p-10 space-y-8">
        @if (session('status'))
    <div id="status-alert" class="mb-8 flex items-center justify-between p-5 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-[2rem] shadow-sm animate-in fade-in slide-in-from-top-4 duration-500">
        <div class="flex items-center gap-3">
            <div class="bg-emerald-500 p-1.5 rounded-full">
                <flux:icon name="check" variant="mini" class="size-4 text-white" />
            </div>
            <span class="text-sm font-black tracking-tight uppercase italic">
                {{ session('status') }}
            </span>
        </div>
        
        <button type="button" onclick="document.getElementById('status-alert').remove()" class="text-emerald-300 hover:text-emerald-600 transition-colors">
            <flux:icon name="x-mark" variant="mini" class="size-5" />
        </button>
    </div>
@endif
        <div class="mb-6 relative">
    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
        <flux:icon name="magnifying-glass" variant="mini" class="size-4 text-zinc-400" />
    </div>
    <input type="text" 
        placeholder="Buscar categoría..." 
        class="w-full pl-11 pr-4 py-3 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm"
    >
</div>
        
       <div class="flex items-center gap-3">
    <h1 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight italic">Categorías</h1>
    <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-black shadow-inner">
        {{ $categories->count() }}
    </span>
</div>
            
            @if (session('status'))
                <div class="px-6 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl font-bold text-sm animate-pulse">
                    {{ session('status') }}
                </div>
            @endif
        </div>

        <div class="flex flex-col lg:flex-row gap-12 items-start">
            
            <div class="w-full lg:w-[35%]">
                <div class="bg-white dark:bg-zinc-900 p-8 rounded-[2.5rem] border border-zinc-200 dark:border-zinc-800 shadow-xl shadow-zinc-200/50 sticky top-10">
                    <h2 class="text-xs font-black uppercase tracking-[0.2em] text-zinc-400 mb-8 flex items-center gap-2">
                        <span class="w-2 h-2 bg-indigo-500 rounded-full animate-ping"></span>
                        Nuevo Registro
                    </h2>
                    
                    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-2">
                            <label class="block text-xs font-black text-zinc-500 uppercase ml-1">Nombre de categoría</label>
                            <input type="text" name="name" 
                                class="w-full px-5 py-4 bg-zinc-100 dark:bg-zinc-800 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none text-lg font-bold"
                                placeholder="Tecnología..." required>
                        </div>
                        
                       <button type="submit" 
    onclick="this.innerHTML='<span class=\'animate-spin mr-2\'>🌀</span> Guardando...'; this.classList.add('opacity-70')"
    class="w-full py-4 bg-linear-to-r from-indigo-600 to-violet-600 ...">
    Guardar Cambios
</button>
                    </form>
                </div>
            </div>

            <div class="w-full lg:w-[65%]">
                <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] border border-zinc-200 dark:border-zinc-800 shadow-xl shadow-zinc-200/50 overflow-hidden">
                    <div class="px-8 py-5 bg-zinc-50/50 dark:bg-zinc-800/50 border-b border-zinc-100 dark:border-zinc-800">
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-zinc-400">Registros en Base de Datos</span>
                    </div>

                    <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @forelse($categories as $category)
                            <div class="category-row flex items-center justify-between p-8 group hover:bg-zinc-50/50 transition-all duration-300">
                                <div class="flex items-center gap-6">
                                    <span class="text-[10px] font-black text-zinc-400 font-mono bg-zinc-100 dark:bg-zinc-800 w-12 h-12 flex items-center justify-center rounded-2xl border border-zinc-200/50">
                                        #{{ $category->id }}
                                    </span>
                                    
                                    <div>
                                        <div class="text-xl font-bold text-zinc-800 dark:text-zinc-200 group-hover:text-indigo-600 transition-colors italic leading-none">
                                            {{ $category->name }}
                                        </div>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[9px] font-black bg-zinc-100 dark:bg-zinc-800 text-zinc-500 uppercase tracking-widest mt-2 border border-zinc-200/20">
                                            {{ $category->slug }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <flux:modal.trigger name="edit_modal_{{ $category->id }}">
                                        <button class="flex items-center justify-center w-11 h-11 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all duration-300 shadow-sm active:scale-90">
                                            <flux:icon name="pencil-square" variant="mini" class="size-5" />
                                        </button>
                                    </flux:modal.trigger>

                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('¿Borrar categoría?')" 
                                            class="flex items-center justify-center w-11 h-11 rounded-2xl bg-rose-50 dark:bg-rose-500/10 text-rose-600 hover:bg-rose-600 hover:text-white transition-all duration-300 shadow-sm active:scale-90">
                                            <flux:icon name="trash" variant="mini" class="size-5" />
                                        </button>
                                    </form>
                                </div>

                                <flux:modal name="edit_modal_{{ $category->id }}" class="md:w-[480px] !rounded-[3rem] p-10">
                                    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-8">
                                        @csrf @method('PUT')
                                        <div class="text-center">
                                            <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-3xl flex items-center justify-center mx-auto mb-4">
                                                <flux:icon name="pencil-square" variant="outline" class="size-8" />
                                            </div>
                                            <h3 class="text-2xl font-black text-zinc-900 dark:text-white tracking-tight">Editar Categoría</h3>
                                            <p class="text-zinc-500 text-sm">Estás editando el registro #{{ $category->id }}</p>
                                        </div>
                                        
                                        <flux:input name="name" label="Nuevo Nombre" value="{{ $category->name }}" class="!rounded-2xl" required />
                                        
                                        <div class="flex gap-4 pt-4">
                                            <flux:modal.close>
                                                <flux:button variant="ghost" class="flex-1 !rounded-2xl font-bold py-3 px-6">Cerrar</flux:button>
                                            </flux:modal.close>
                                            <flux:button type="submit" variant="primary" class="flex-1 !rounded-2xl font-bold py-3 px-6 bg-indigo-600">Actualizar</flux:button>
                                        </div>
                                    </form>
                                </flux:modal>
                            </div>
                        @empty
                            <div class="p-24 text-center">
                                <flux:icon name="archive-box" class="size-12 mx-auto text-zinc-200 mb-4" />
                                <p class="text-zinc-400 font-bold italic uppercase tracking-widest text-xs">No hay categorías registradas</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>