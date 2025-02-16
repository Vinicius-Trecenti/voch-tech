<?php

namespace App\Livewire\Colaboradores;

use Livewire\Component;
use App\Models\Unidade;
use App\Models\Colaborador;

class Create extends Component
{
    public $showModal = false;

    public $nome;
    public $email;
    public $cpf;
    public $unidade_id;

    public $unidades;

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

    public function save()
    {
        $this->validate([
            'nome' => 'required|min:3|max:255',
            'email' => 'required|min:3|max:255|unique:colaboradores|email',
            'cpf' => 'required|min:11|unique:colaboradores',
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
            'cpf.unique' => 'O CPF informado já existe na base de dados',
            'unidade_id.required' => 'O campo unidade é obrigatório',
        ]);

        Colaborador::create([
            'nome' => $this->nome,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'unidade_id' => $this->unidade_id,
        ]);

        $this->showModal = false;
        $this->reset('nome');
        $this->reset('email');
        $this->reset('cpf');
        $this->reset('unidade_id');

        redirect(route('colaboradores'))->with('success', 'Colaborador criado com sucesso');
    }


    public function openModal()
    {
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.colaboradores.create');
    }
}
