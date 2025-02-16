<div class="p-4">
    <x-ts-table :$headers :$rows filter id="grupos">
        @interact('column_actions', $row)
            <div class="flex gap-2">
                <x-ts-button icon="pencil" position="left" outline wire:click="openModalEdit({{ $row }})"/>

                <x-ts-button icon="trash" color="red" position="left" outline wire:click="openModalDelete({{ $row }})"/>
            </div>
        @endinteract
    </x-ts-table>


    {{-- Modal de Edição --}}
    <div x-data="{ open: @entangle('showModalEdit') }" x-show="open" x-transition.opacity class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg w-96">
            <h2 class="text-xl font-semibold mb-4 text-black">Editar grupo</h2>

            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-ts-errors />
                </div>

                <div class="col-span-12">
                    <x-ts-input label="Nome do grupo" wire:model="nome" />
                </div>
            </div>

            <div class="flex justify-center space-x-4 mt-4">
                <x-ts-button color="gray" x-on:click="open = false">
                    {{ __('Cancelar') }}
                </x-ts-button>

                <x-ts-button wire:click="edit">
                    {{ __('Salvar') }}
                </x-ts-button>
            </div>
        </div>
    </div>

    {{-- Modal de Exclusão --}}
    <div x-data="{ open: @entangle('showModalDelete') }" x-show="open" x-transition.opacity class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg w-96">
            <h2 class="text-xl font-semibold mb-4 text-black">Deletar grupo</h2>

            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <p>Tem certeze que deseja deletar?</p>
                    <p class="text-black my-4">O grupo <span class="font-bold">{{ $grupoNome }} </span> será deletado.</p>

                </div>
            </div>

            <div class="flex justify-center space-x-4 mt-4">
                <x-ts-button color="gray" x-on:click="open = false">
                    {{ __('Cancelar') }}
                </x-ts-button>

                <x-ts-button wire:click="delete" color="red">
                    {{ __('Confirmar') }}
                </x-ts-button>
            </div>
        </div>
    </div>
</div>
