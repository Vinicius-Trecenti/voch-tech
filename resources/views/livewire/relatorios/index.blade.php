<div class="grid grid-cols-4 gap-4 px-6 pb-6">
        <div class="col-span-4">
            <x-ts-select.styled
            placeholder="Selecione.."
            label="Tipo de relatório"
            select="label:label|value:value"
            :options="[
                ['label' => 'Grupos', 'value' => 'grupos'],
                ['label' => 'Bandeiras', 'value' => 'bandeiras'],
                ['label' => 'Unidades', 'value' => 'unidades'],
                ['label' => 'Colaboradores', 'value' => 'colaboradores'],
            ]"
            wire:model.live="tipo"  />
        </div>


        <div class="col-span-4 mt-4">
            <h1 class="text-lg font-semibold">Filtros</h1>
        </div>

        <div class="col-span-2 lg:col-span-1">
            <x-ts-select.styled
            :placeholders="[
                'default' => 'Selecione..',
                'search'  => 'Pesquisar..',
                'empty'   => 'Nenhum grupo econômico encontrado.',
            ]"
            label="Grupo econômico"
            select="label:label|value:value"
            :options="$grupos" wire:model.live="grupo" searchable/>
        </div>

        <div class="col-span-2 lg:col-span-1">
            <x-ts-select.styled
            :placeholders="[
                'default' => 'Selecione..',
                'search'  => 'Pesquisar..',
                'empty'   => 'Nenhuma bandeira encontrada.',
            ]"
            label="Bandeira"
            select="label:label|value:value"
            :options="$bandeiras" searchable/>
        </div>

        <div class="col-span-2 lg:col-span-1">
            <x-ts-select.styled
            :placeholders="[
                'default' => 'Selecione..',
                'search'  => 'Pesquisar..',
                'empty'   => 'Nenhuma unidade encontrada.',
            ]"
            label="Unidade"
            select="label:label|value:value"
            :options="$unidades" searchable/>
        </div>

        <div class="col-span-2 lg:col-span-1">
            <x-ts-select.styled
            :placeholders="[
                'default' => 'Selecione..',
                'search'  => 'Pesquisar..',
                'empty'   => 'Nenhum colaborador encontrado.',
            ]"
            label="Colaborador"
            select="label:label|value:value"
            :options="$colaboradores" searchable/>
        </div>

        <div class="col-span-4 mt-4">
            <h1 class="text-lg font-semibold">Opções</h1>
        </div>

        <div class="col-span-4">
            <div class="mb-2">
                <x-ts-radio color="green" label="Ordenar por ID" wire:model.live="ordenacao" id="radio-id" value="id"/>
            </div>

            <div class="mb-2">
                <x-ts-radio color="green" label="Ordenar por nome" wire:model.live="ordenacao" id="radio-nome" value="nome"/>
            </div>

            <div class="mb-2">
                <x-ts-radio color="green" label="Ordenar por data de criação" wire:model.live="ordenacao" id="radio-created" value="created_at"/>
            </div>

            <div class="mb-2">
                <x-ts-radio color="green" label="Ordenar por data de atualização" wire:model.live="ordenacao" id="radio-updated" value="updated_at"/>
            </div>
        </div>

        <div class="col-span-4 mt-4">
            <x-ts-button icon="cloud-arrow-down" color="green" wire:click="gerar" >
                {{ __('Gerar relatório Excel') }}
            </x-ts-button>

            <x-ts-button icon="document-arrow-down" color="red" wire:click="gerarPDF" >
                {{ __('Gerar relatório PDF') }}
            </x-ts-button>
        </div>
</div>
