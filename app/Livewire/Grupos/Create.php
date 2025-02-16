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

        Grupo::create([
            'nome' => $this->nome,
        ]);

        $this->showModal = false;
        $this->reset('nome');

        redirect(route('grupos'))->with('success', 'Grupo criado com sucesso');
    }

    public function render()
    {
        return view('livewire.grupos.create');
    }
}