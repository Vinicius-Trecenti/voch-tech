<?php

namespace App\Livewire\Unidades;

use Livewire\Component;
use App\Models\Unidade;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use App\Models\Bandeira;

class Index extends Component
{
    use WithPagination;

    public ?int $quantity = 10;

    public ?string $search = null;

    public $unidade;

    public $nomeUnidade;

    public $nome_fantasia;

    public $razao_social;

    public $cnpj;

    public $bandeira_id;

    public array $bandeiras = [];

    public bool $showModalDelete = false;

    public bool $showModalEdit = false;

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

    public function mount()
    {
        $options = Bandeira::all()->toArray();

        foreach($options as $option){
            $this->bandeiras[] = [
                'label' => $option['nome'],
                'value' => $option['id']
            ];
        }
    }

    public function openModalEdit($row)
    {
        $this->unidade = $row;
        $this->nome_fantasia = $row['nome_fantasia'];
        $this->razao_social = $row['razao_social'];
        $this->cnpj = $row['cnpj'];
        $this->bandeira_id = $row['bandeira_id'];
        $this->showModalEdit = true;
    }

    public function edit(){
        $this->validate([
            'nome_fantasia' => 'required|min:3|max:255',
            'razao_social' => 'required|min:3|max:255',
            'cnpj' => 'required|min:14|max:255',
            'bandeira_id' => 'required',
        ],
        [
            'nome_fantasia.required' => 'O campo nome fantasia é obrigatório',
            'nome_fantasia.min' => 'O campo nome fantasia deve ter no mínimo 3 caracteres',
            'nome_fantasia.max' => 'O campo nome fantasia deve ter no maximo 255 caracteres',
            'razao_social.required' => 'O campo razao social é obrigatório',
            'razao_social.min' => 'O campo razao social deve ter no mínimo 3 caracteres',
            'razao_social.max' => 'O campo razao social deve ter no maximo 255 caracteres',
            'cnpj.required' => 'O campo cnpj é obrigatório',
            'cnpj.min' => 'O campo cnpj deve ter no mínimo 14 caracteres',
            'cnpj.max' => 'O campo cnpj deve ter no maximo 255 caracteres',
            'bandeira_id.required' => 'O campo bandeira é obrigatório',
        ]);

        Unidade::where('id', $this->unidade['id'])->update([
            'nome_fantasia' => $this->nome_fantasia,
            'razao_social' => $this->razao_social,
            'cnpj' => $this->cnpj,
            'bandeira_id' => $this->bandeira_id,
        ]);

        $this->showModalEdit = false;

        $this->reset('nome_fantasia');
        $this->reset('razao_social');
        $this->reset('cnpj');
        $this->reset('bandeira_id');

        redirect(route('unidades'))->with('success', 'Unidade atualizada com sucesso');
    }

    public function openModalDelete($row)
    {
        $this->unidade = $row;
        $this->nomeUnidade = $row['nome_fantasia'] . ' - ' . $row['razao_social'];
        $this->showModalDelete = true;
    }

    public function delete()
    {
        Unidade::where('id', $this->unidade['id'])->delete();
        $this->showModalDelete = false;

        $this->reset('unidade');

        redirect(route('unidades'))->with('success', 'Unidade deletada com sucesso');
    }

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
