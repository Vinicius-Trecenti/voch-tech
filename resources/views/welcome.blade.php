<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Plus</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex items-center space-x-3">
                            <svg class="w-8 h-8 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span class="text-xl font-semibold text-violet-600 dark:text-violet-400">Plus</span>
                        </div>
                    </header>

                    <main class="">
                        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                            <div class="col-span-1">
                                <img src="{{ asset('logo.svg') }}" alt="logo" class="">
                            </div>

                            <div class="col-span-1">
                                <div class="text-center bg-violet-500 rounded-md">
                                    <h1 class="text-2xl font-bold text-white p-4" >Bem vindo ao {{ config('app.name', 'Plus') }}</h1>

                                    <div class="text-start p-4">
                                        <p class="text-white mb-4">Aqui você pode gerenciar seu Grupo econômico, Bandeira, Unidade e Colaboradores de forma simplificada.</p>
                                        <ul class="list-inside list-disc">
                                            <li class="text-white">Veja os colaboradores que fazem parte da sua unidade</li>
                                            <li class="text-white">Veja o dashboard com dados sobre o Grupo, Unidade e Bandeira</li>
                                            <li class="text-white">Faça Auditoria das ações realizadas dentro do Plus</li>
                                            <li class="text-white">Realize downloads de relatórios em formato Excel</li>
                                        </ul>
                                    </div>

                                    <div class="p-4">
                                        @if (Route::has('login'))
                                            <livewire:welcome.navigation />
                                        @endif
                                </div>
                            </div>
                        </div>
                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Plus') }}. Todos os direitos reservados. <span class="font-bold text-violet-600">Desenvolvido por Vinicius Trecenti</span></p>
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
