<?php

namespace App\Livewire\Unidades;

use Livewire\Component;
use App\Models\Unidade;

class Index extends Component
{

    public array $headers = [
        ['index' => 'id', 'label' => 'ID'],
        ['index' => 'nome_fantasia', 'label' => 'Nome fantasia'],
        ['index' => 'razao_social', 'label' => 'Razão social'],
        ['index' => 'cnpj', 'label' => 'CNPJ'],
        ['index' => 'bandeira.nome', 'label' => 'Bandeira'],
        ['index' => 'created_at', 'label' => 'Criado em'],
        ['index' => 'updated_at', 'label' => 'Atualizado em'],
        ['index' => 'actions', 'label' => 'Ações'],
    ];

    public function render()
    {
        return view('livewire.unidades.index', [
            'rows' => Unidade::all(),
        ]);
    }
}
