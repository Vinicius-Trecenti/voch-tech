<?php

namespace App\Livewire\Grupos;

use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Edit extends Component
{
    use Interactions;

    public $grupo;
    public $nome;
    public $showModal = false;

    public function mount($row)
    {
        $this->grupo = $row;
        $this->nome = $row->nome;
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'nome' => 'required|min:3',
        ],
        [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
        ]);

        $this->grupo->update([
            'nome' => $this->nome,
        ]);

        $this->showModal = false;
        $this->reset('nome');

        redirect(route('grupos'))->with('success', 'Grupo atualizado com sucesso');
    }


    public function render()
    {
        return view('livewire.grupos.edit');
    }
}
