<div class="p-4">
    <x-ts-table :$headers :$rows id="colaboradores">

        @interact('column_actions', $row)
            <div class="flex gap-2">
                <livewire:colaboradores.edit :$row />

                <livewire:colaboradores.delete :$row />
            </div>
        @endinteract
    </x-ts-table>
</div>
