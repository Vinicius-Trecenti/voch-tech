<div class="flex ml-4 mt-4">
    <x-ts-button icon="user-plus" position="left" outline wire:click="openModal">
        Criar Colaborador
    </x-ts-button>

    <div x-data="{ open: @entangle('showModal') }" x-show="open" x-transition.opacity class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg w-[500px]">
            <h2 class="text-xl font-semibold mb-4">Criar Colaborador</h2>

            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-ts-errors />
                </div>

                <div class="col-span-12">
                    <x-ts-input label="Nome" wire:model="nome" />
                </div>

                <div class="col-span-12">
                    <x-ts-input label="Email" wire:model="email"/>
                </div>

                <div class="col-span-12">
                    <x-ts-input label="CPF" wire:model="cpf" x-mask="999.999.999-99"/>
                </div>

                <div class="col-span-12">
                    <x-ts-select.styled placeholder="Selecione.." label="Unidade do colaborador"
                        wire:model.live="unidade_id"
                        select="label:label|value:value" :options="$unidades" />
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
