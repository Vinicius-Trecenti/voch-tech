<?php

namespace App\Livewire\Grupos;

use Livewire\Component;
use App\Models\Grupo;
use TallStackUi\Traits\Interactions;


class Create extends Component
{
    use Interactions;

    public $name;
    public $showModal = false;

    public function openModal()
    {
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:3',
        ],
        [
            'name.required' => 'O campo nome é obrigatório',
            'name.min' => 'O campo nome deve ter no mínimo 3 caracteres',
        ]);

        Grupo::create([
            'nome' => $this->name,
        ]);

        $this->showModal = false;
        $this->reset('name');

        redirect(route('grupos'))->with('success', 'Grupo criado com sucesso');
    }

    public function render()
    {
        return view('livewire.grupos.create');
    }
}