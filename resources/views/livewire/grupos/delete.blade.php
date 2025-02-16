<div class="">
    <x-ts-button icon="trash" color="red" position="left" outline wire:click="openModal"/>

    <div x-data="{ open: @entangle('showModal') }" x-show="open" x-transition.opacity class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg w-96">
            <h2 class="text-xl font-semibold mb-4 text-black">Deletar grupo</h2>

            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <p>Tem certeze que deseja deletar?</p>
                    <p class="text-black my-4">O grupo {{ $grupo->nome }} será deletado.</p>

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
