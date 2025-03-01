<div class="flex ml-4 mt-4">
    <x-ts-button icon="flag" position="left" outline wire:click="openModal">
        Criar Bandeira
    </x-ts-button>

    <div x-data="{ open: @entangle('showModal') }" x-show="open" x-transition.opacity class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg w-[500px]">
            <h2 class="text-xl font-semibold mb-4">Criar Bandeira</h2>

            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-ts-errors />
                </div>

                <div class="col-span-12">
                    <x-ts-input label="Nome da bandeira" wire:model="nome" />
                </div>

                <div class="col-span-12">
                    <x-ts-select.styled placeholder="Selecione.." label="Grupo econômico" wire:model.live="grupo_id"
                        select="label:label|value:value" :options="$grupos" />
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-12">
                <x-ts-button color="gray" x-on:click="open = false">
                    {{ __('Cancelar') }}
                </x-ts-button>

                <x-ts-button wire:click="save">
                    {{ __('Salvar') }}
                </x-ts-button>
            </div>
        </div>
    </div>
</div>
