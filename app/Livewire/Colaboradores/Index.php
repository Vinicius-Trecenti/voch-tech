<?php

namespace App\Livewire\Colaboradores;

use Livewire\Component;
use App\Models\Colaborador;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public ?int $quantity = 10;

    public ?string $search = null;

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
            'rows' => Colaborador::query()
                ->when($this->search, function (Builder $query) {
                    return $query->where('nome', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orWhere('cpf', 'like', "%{$this->search}%");
                })
                ->paginate($this->quantity)
                ->withQueryString(),
        ]);
    }
}
