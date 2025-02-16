<?php

namespace App\Livewire\Colaboradores;

use Livewire\Component;
use App\Models\Colaborador;

class Index extends Component
{
    public array $headers = [
        ['index' => 'id', 'label' => 'ID'],
        ['index' => 'nome', 'label' => 'Nome'],
        ['index' => 'email', 'label' => 'Email'],
        ['index' => 'cpf', 'label' => 'CPF'],
        ['index' => 'unidade.nome_fantasia', 'label' => 'Unidade'],
        ['index' => 'created_at', 'label' => 'Criado em'],
        ['index' => 'updated_at', 'label' => 'Atualizado em'],
        ['index' => 'actions', 'label' => 'Ações'],
    ];

    public function render()
    {
        return view('livewire.colaboradores.index', [
            'rows' => Colaborador::all(),
        ]);
    }
}
