<x-app-layout>
    <x-slot name="header">
        <h2 class="flex gap-2 items-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            <x-ts-icon name="arrow-down-tray" class="h-5 w-5"/>
            {{ __('Relatórios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 font-bold">
                    {{ __("Faça download dos relatórios do sistema") }}
                </div>

                <livewire:relatorios.index />
            </div>
        </div>
    </div>
</x-app-layout>


