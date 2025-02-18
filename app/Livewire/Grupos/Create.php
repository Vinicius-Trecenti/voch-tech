<?php

namespace App\Livewire\Grupos;

use Livewire\Component;
use App\Models\Grupo;
use TallStackUi\Traits\Interactions;


class Create extends Component
{
    use Interactions;

    public $nome;
    public $showModal = false;

    public function openModal()
    {
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'nome' => 'required|min:3|max:255',
        ],
        [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no maximo 255 caracteres',
        ]);

        $status = Grupo::create([
            'nome' => $this->nome,
        ]);

        $this->showModal = false;
        $this->reset('nome');

        ($status) ?
        $this->toast()->timeout(seconds: 5)->success('Sucesso', 'O grupo foi criado com sucesso')->flash()->send() :
        $this->toast()->timeout(seconds: 5)->error('Erro', 'Ocorreu um erro ao criar o grupo')->flash()->send();

        redirect(route('grupos'));
    }

    public function render()
    {
        return view('livewire.grupos.create');
    }
}