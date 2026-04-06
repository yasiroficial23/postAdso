<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl p-4">
        <flux:heading size="xl">Dashboard</flux:heading>
        <flux:subheading>Bienvenido al panel principal.</flux:subheading>
        
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <flux:card class="aspect-video flex items-center justify-center">
                <flux:text>Contenido del Dashboard</flux:text>
            </flux:card>
        </div>
    </div>
</x-layouts::app>