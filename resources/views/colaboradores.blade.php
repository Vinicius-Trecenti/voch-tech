<x-app-layout>
    <x-slot name="header">
        <h2 class="flex gap-2 items-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-ts-icon name="user-group" class="h-5 w-5"/>
            {{ __('Colaboradores') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 font-bold">
                    {{ __("Gerencie os colaboradores") }}
                </div>

                <livewire:colaboradores.create />
                <livewire:colaboradores.index />
            </div>
        </div>
    </div>
</x-app-layout>
