<div class="flex ml-4 mt-4">
    <x-ts-button icon="building-storefront" position="left" outline wire:click="openModal">
        Criar Unidade
    </x-ts-button>

    <div x-data="{ open: @entangle('showModal') }" x-show="open" x-transition.opacity class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg w-[500px]">
            <h2 class="text-xl font-semibold mb-4">Criar Unidade</h2>

            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-ts-errors />
                </div>

                <div class="col-span-12">
                    <x-ts-input label="Nome da Fantasia" wire:model="nome_fantasia" />
                </div>

                <div class="col-span-12">
                    <x-ts-input label="Razão Social" wire:model="razao_social" />
                </div>

                <div class="col-span-12">
                    <x-ts-input label="CNPJ" wire:model="cnpj" x-mask="99.999.999/9999-99"/>
                </div>

                <div class="col-span-12">
                    <x-ts-select.styled placeholder="Selecione.." label="Bandeira da unidade"
                        wire:model.live="bandeira_id"
                        select="label:label|value:value" :options="$bandeiras" />
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
