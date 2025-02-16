<div class="p-4">
    <x-ts-table :$headers :$rows id="grupos">
        @interact('column_actions', $row)
            <div class="flex gap-2">
                <livewire:grupos.edit :$row />

                <livewire:grupos.delete :$row />
            </div>
        @endinteract
    </x-ts-table>
</div>
