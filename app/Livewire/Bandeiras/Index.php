<?php

namespace App\Livewire\Bandeiras;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Bandeira;

class Index extends Component
{
    use WithPagination;

    // public ?int $quantity = 10;

    // public ?string $search = null;

    public array $headers = [
        ['index' => 'id', 'label' => 'ID'],
        ['index' => 'nome', 'label' => 'Nome'],
        ['index' => 'grupo.nome', 'label' => 'Grupo Econômico'],
        ['index' => 'created_at', 'label' => 'Criado em'],
        ['index' => 'updated_at', 'label' => 'Atualizado em'],
        ['index' => 'actions', 'label' => 'Ações'],
    ];


    public function render()
    {
        return view('livewire.bandeiras.index', [
            'rows' => Bandeira::all(),
        ]);
    }
}
