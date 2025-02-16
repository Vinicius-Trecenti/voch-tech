<?php

namespace App\Livewire\Unidades;

use Livewire\Component;
use App\Models\Unidade;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public ?int $quantity = 10;

    public ?string $search = null;

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
            'rows' => Unidade::query()
            ->when($this->search, function (Builder $query) {
                return $query->where('nome_fantasia', 'like', "%{$this->search}%")
                ->orWhere('razao_social', 'like', "%{$this->search}%")
                ->orWhere('cnpj', 'like', "%{$this->search}%");
            })
            ->paginate($this->quantity)
            ->withQueryString(),
        ]);
    }
}
