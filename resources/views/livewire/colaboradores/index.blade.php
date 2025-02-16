<div class="p-4">
    <x-ts-table :$headers :$rows filter id="colaboradores">

        @interact('column_actions', $row)
            <div class="flex gap-2">
                <x-ts-button icon="pencil" position="left" outline wire:click="openModalEdit({{ $row }})"/>

                <x-ts-button icon="trash" color="red" position="left" outline wire:click="openModalDelete({{ $row }})"/>
            </div>
        @endinteract
    </x-ts-table>
</div>
