<div class="p-4">
    <x-ts-table :$headers :$rows id="unidades">

        @interact('column_actions', $row)
            <div class="flex gap-2">
                <livewire:unidades.edit :$row />

                <livewire:unidades.delete :$row />
            </div>
        @endinteract
    </x-ts-table>
</div>
