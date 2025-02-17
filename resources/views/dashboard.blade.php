<x-app-layout>
    <x-slot name="header">
        <h2 class="flex gap-2 items-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-ts-icon name="clipboard-document-list" class="h-5 w-5"/>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-xl">
                    {{ __("Bem vindo")}} {{ auth()->user()->name }}!
                </div>

                <div class="flex flex-col lg:flex-row justify-center gap-4 px-4 mb-8">
                    <x-ts-stats title="Colaboradores" icon="user-group"          number="{{ $colaboradores }}" animated />
                    <x-ts-stats title="Unidades"      icon="building-storefront" number="{{ $unidades }}"      animated />
                    <x-ts-stats title="Bandeiras"     icon="flag"                number="{{ $bandeiras }}"     animated />
                </div>

                <hr class="my-4 mx-2">

                <h2 class="px-4">Colaboradores por unidade</h2>

                <div class="justify-center w-full px-8 mb-8 hidden lg:block">
                    <canvas id="colaboradoresByUnidade"></canvas>
                </div>

                <div class="block lg:hidden w-full max-w-sm">
                  <canvas id="colaboradoresByUnidadeDonut"></canvas>
              </div>

            </div>
        </div>
    </div>
</x-app-layout>


<script>
  var dados = @json($dados);
  const ctx = document.getElementById('colaboradoresByUnidade');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: dados.map(unidade => unidade.unidade),
      datasets: [{
        label: 'Colaboradores por Unidade',
        data: dados.map(unidade => unidade.colaboradores),
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
        ],
        borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

</script>


<script>
  var dadosDonut = @json($dados);
  const cty = document.getElementById('colaboradoresByUnidadeDonut');

  new Chart(cty, {
    type: 'doughnut',
    data: {
      labels: dadosDonut.map(unidade => unidade.unidade),
      datasets: [{
        label: 'Colaboradores por Unidade',
        data: dadosDonut.map(unidade => unidade.colaboradores),
        borderWidth: 1
      }]
    },
  });
</script>