<?php

namespace App\Livewire\Grupos;

use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Delete extends Component
{
    use Interactions;

    public $grupo;
    public $showModal = false;

    public function mount($row)
    {
        $this->grupo = $row;
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function delete()
    {
        $this->grupo->delete();
        $this->showModal = false;
        redirect()->route('grupos')->with('success', 'Grupo deletado com sucesso');
    }

    public function render()
    {
        return view('livewire.grupos.delete');
    }
}
