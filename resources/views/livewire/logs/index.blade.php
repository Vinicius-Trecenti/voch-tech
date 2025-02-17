<div class="p-4">
    <x-ts-table :$headers :$rows filter id="logs">
        @interact('column_evento', $row)
            @if($row['evento'] == 'Criação')
                <x-ts-badge text="Criação" color="green"/>
            @elseif($row['evento'] == 'Atualização')
                <x-ts-badge text="Atualização" color="blue"/>
            @elseif($row['evento'] == 'Exclusão')
                <x-ts-badge text="Exclusão" color="red"/>
            @endif
        @endinteract
        @interact('column_detalhes', $row)
            <pre class="text-sm">{{ json_encode($row['detalhes'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
        @endinteract
    </x-ts-table>
</div>