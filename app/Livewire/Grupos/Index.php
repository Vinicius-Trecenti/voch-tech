<?php

namespace App\Livewire\Grupos;

use App\Models\Grupo;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

use TallStackUi\Traits\Interactions;

class Index extends Component
{
    use WithPagination;

    use Interactions;

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

        $status = $grupo->update([
            'nome' => $this->nome,
        ]);

        $this->showModalEdit = false;
        $this->reset('nome');

        ($status) ?
        $this->toast()->timeout(seconds: 5)->info('Sucesso', 'O grupo foi atualizado com sucesso')->flash()->send() :
        $this->toast()->timeout(seconds: 5)->error('Erro', 'Ocorreu um erro ao atualizar o grupo')->flash()->send();

        redirect(route('grupos'));
    }

    public function delete()
    {
        $grupo = Grupo::where('id', $this->grupo['id'])->first();
        $status = $grupo->delete();
        $this->showModalDelete = false;

        ($status) ?
        $this->toast()->timeout(seconds: 5)->info('Sucesso', 'O grupo foi deletado com sucesso')->flash()->send() :
        $this->toast()->timeout(seconds: 5)->error('Erro', 'Ocorreu um erro ao deletar o grupo')->flash()->send();

        redirect(route('grupos'));
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
