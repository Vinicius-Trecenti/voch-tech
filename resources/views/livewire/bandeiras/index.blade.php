<div class="p-4">
    <x-ts-table :$headers :$rows id="bandeiras">
        
        @interact('column_actions', $row)
            <div class="flex gap-2">
                <livewire:bandeiras.edit :$row />

                <livewire:bandeiras.delete :$row />
            </div>
        @endinteract
    </x-ts-table>
</div>
