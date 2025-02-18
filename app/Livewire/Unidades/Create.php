<?php

namespace App\Livewire\Unidades;

use Livewire\Component;
use App\Models\Bandeira;
use App\Models\Unidade;

use TallStackUi\Traits\Interactions;

class Create extends Component
{
    use Interactions;

    public $showModal = false;

    public $nome_fantasia;
    public $razao_social;
    public $cnpj;
    public $bandeira_id;

    public $bandeiras = [];

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

    public function save()
    {
        $this->validate([
            'nome_fantasia' => 'required|min:3|max:255',
            'razao_social' => 'required|min:3|max:255',
            'cnpj' => 'required|min:3|max:255|unique:unidades',
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
            'cnpj.min' => 'O campo cnpj deve ter no mínimo 3 caracteres',
            'cnpj.max' => 'O campo cnpj deve ter no maximo 255 caracteres',
            'bandeira_id.required' => 'O campo bandeira é obrigatório',
            'cnpj.unique' => 'O CNPJ informado já existe na base de dados',
        ]);

        $status = Unidade::create([
            'nome_fantasia' => $this->nome_fantasia,
            'razao_social' => $this->razao_social,
            'cnpj' => $this->cnpj,
            'bandeira_id' => $this->bandeira_id,
        ]);

        $this->showModal = false;
        $this->reset('nome_fantasia');
        $this->reset('razao_social');
        $this->reset('cnpj');
        $this->reset('bandeira_id');

        ($status) ?
        $this->toast()->timeout(seconds: 5)->success('Sucesso', 'A unidade foi criada com sucesso')->flash()->send() :
        $this->toast()->timeout(seconds: 5)->error('Erro', 'Ocorreu um erro ao criar a unidade')->flash()->send();

        redirect(route('unidades'));
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.unidades.create');
    }
}
