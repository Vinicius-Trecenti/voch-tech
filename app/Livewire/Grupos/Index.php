<?php

namespace App\Livewire\Grupos;

use App\Models\Grupo;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // public ?int $quantity = 10;

    // public ?string $search = null;

    public array $headers = [
        ['index' => 'id', 'label' => 'ID'],
        ['index' => 'nome', 'label' => 'Nome'],
        ['index' => 'created_at', 'label' => 'Criado em'],
        ['index' => 'updated_at', 'label' => 'Atualizado em'],
        ['index' => 'actions', 'label' => 'Ações'],
    ];


    public function render()
    {
        return view('livewire.grupos.index', [
            'rows' => Grupo::all(),
        ]);
    }
}
