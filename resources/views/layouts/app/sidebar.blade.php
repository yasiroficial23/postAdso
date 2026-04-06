@php
$groups = [
    'Platform' => [
        [
            'name' => 'Dashboard',
            'icon' => 'home',
            'url' => route('dashboard'),
            'current' => request()->routeIs('dashboard'),
        ],
        [
            'name' => 'Categorias',
            'icon' => 'funnel',
            'url' => Route::has('admin.categories.index') ? route('admin.categories.index') : '#',
            'current' => request()->routeIs('admin.categories.index'),
        ],
    ]
];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky collapsible="mobile" class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                @foreach ($groups as $group => $links)
                    <flux:sidebar.group :heading="$group" class="grid">
                        @foreach ($links as $link)
                            <flux:sidebar.item :icon="$link['icon']" :href="$link['url']" :current="$link['current']" wire:navigate>
                                {{ $link['name'] }}
                            </flux:sidebar.item>
                        @endforeach    
                    </flux:sidebar.group>
                @endforeach
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                    Repository
                </flux:sidebar.item>

                <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                    Documentation
                </flux:sidebar.item>
            </flux:sidebar.nav>

            @if(auth()->check())
                <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
            @endif
        </flux:sidebar>

        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <flux:spacer />
            {{-- Menú móvil simplificado para evitar errores de objetos nulos --}}
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>