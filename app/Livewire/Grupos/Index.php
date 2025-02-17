<?php

namespace App\Livewire\Grupos;

use App\Models\Grupo;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class Index extends Component
{
    use WithPagination;

    public ?int $quantity = 5;

    public ?string $search = null;

    public array $headers = [
        ['index' => 'id', 'label' => 'ID'],
        ['index' => 'nome', 'label' => 'Nome'],
        ['index' => 'created_at', 'label' => 'Criado em'],
        ['index' => 'updated_at', 'label' => 'Atualizado em'],
        ['index' => 'actions', 'label' => 'Ações'],
    ];

    public $showModalEdit = false;
    public $grupo;
    public $nome;
    public $showModalDelete = false;
    public $grupoNome = '';

    public function openModalEdit($row)
    {
        $this->grupo = $row;
        $this->nome = $row['nome'];
        $this->showModalEdit = true;
    }

    public function openModalDelete($row)
    {
        $this->grupoNome = $row['nome'];
        $this->grupo = $row;
        $this->showModalDelete = true;
    }

    public function edit()
    {
        $this->validate([
            'nome' => 'required|min:3',
        ],
        [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
        ]);

        $grupo = Grupo::where('id', $this->grupo['id'])->first();

        $grupo->update([
            'nome' => $this->nome,
        ]);

        $this->showModalEdit = false;
        $this->reset('nome');

        redirect(route('grupos'))->with('success', 'Grupo atualizado com sucesso');
    }

    public function delete()
    {
        $grupo = Grupo::where('id', $this->grupo['id'])->first();
        $grupo->delete();
        $this->showModalDelete = false;
        redirect(route('grupos'))->with('success', 'Grupo deletado com sucesso');
    }

    public function render()
    {
        return view('livewire.grupos.index', [
            'rows' => Grupo::query()
                ->when($this->search, function (Builder $query) {
                    return $query->where('nome', 'like', "%{$this->search}%")
                    ->orWhere('created_at', 'like', "%{$this->search}%")
                    ->orWhere('updated_at', 'like', "%{$this->search}%");
                })
                ->paginate($this->quantity)
        ]);
    }
}
