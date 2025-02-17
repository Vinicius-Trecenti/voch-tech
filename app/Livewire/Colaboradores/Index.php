<?php

namespace App\Livewire\Colaboradores;

use Livewire\Component;
use App\Models\Colaborador;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use App\Models\Unidade;

class Index extends Component
{
    use WithPagination;

    public ?int $quantity = 10;

    public ?string $search = null;

    public $colaborador = [];

    public $nome = '';

    public $email = '';

    public $cpf = '';

    public $unidade_id = '';

    public $unidades = [];

    public $showModalEdit = false;

    public $showModalDelete = false;

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

    public function mount()
    {
        $options = Unidade::all()->toArray();

        foreach($options as $option){
            $this->unidades[] = [
                'label' => $option['nome_fantasia'],
                'value' => $option['id']
            ];
        }
    }

    public function openModalEdit($row)
    {
        $this->colaborador = $row;
        $this->nome = $row['nome'];
        $this->email = $row['email'];
        $this->cpf = $row['cpf'];
        $this->unidade_id = $row['unidade_id'];
        $this->showModalEdit = true;
    }

    public function edit(){
        $this->validate([
            'nome' => 'required|min:3|max:255',
            'email' => 'required|min:3|max:255|email',
            'cpf' => 'required|min:11',
            'unidade_id' => 'required|exists:unidades,id',
        ],
        [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no maximo 255 caracteres',
            'email.required' => 'O campo email é obrigatório',
            'email.min' => 'O campo email deve ter no mínimo 3 caracteres',
            'email.max' => 'O campo email deve ter no maximo 255 caracteres',
            'email.unique' => 'O email informado já existe na base de dados',
            'email.email' => 'O email informado é inválido',
            'cpf.required' => 'O campo CPF é obrigatório',
            'cpf.min' => 'O campo CPF deve ter no mínimo 11 caracteres',
            'unidade_id.required' => 'O campo unidade é obrigatório',
        ]);

        $colaborador = Colaborador::where('id', $this->colaborador['id'])->first();

        $colaborador->update([
            'nome' => $this->nome,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'unidade_id' => $this->unidade_id,
        ]);

        $this->showModalEdit = false;

        $this->reset('nome');
        $this->reset('email');
        $this->reset('cpf');
        $this->reset('unidade_id');

        redirect(route('colaboradores'))->with('success', 'Colaborador atualizado com sucesso');
    }

    public function openModalDelete($row)
    {
        $this->colaborador = $row;
        $this->nome = $row['nome'];
        $this->cpf = $row['cpf'];
        $this->showModalDelete = true;
    }

    public function delete(){
        $colaborador = Colaborador::where('id', $this->colaborador['id'])->first();
        $colaborador->delete();

        $this->showModalDelete = false;

        $this->reset('colaborador');
        $this->reset('nome');
        $this->reset('cpf');
        $this->reset('email');
        $this->reset('unidade_id');

        redirect(route('colaboradores'))->with('success', 'Colaborador deletado com sucesso');

    }

    public function render()
    {
        return view('livewire.colaboradores.index', [
            'rows' => Colaborador::query()
                ->when($this->search, function (Builder $query) {
                    return $query->where('nome', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orWhere('cpf', 'like', "%{$this->search}%")
                    ->orWhere('created_at', 'like', "%{$this->search}%")
                    ->orWhere('updated_at', 'like', "%{$this->search}%")
                    ->orWhereHas('unidade', function (Builder $query) {
                        return $query->where('nome_fantasia', 'like', "%{$this->search}%");
                    });
                })
                ->paginate($this->quantity)

        ]);
    }
}
