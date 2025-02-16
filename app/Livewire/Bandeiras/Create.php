<?php

namespace App\Livewire\Bandeiras;

use App\Models\Bandeira;
use Livewire\Component;
use App\Models\Grupo;

class Create extends Component
{
    public $showModal = false;
    public $nome = '';
    public $grupo_id = '';
    public $grupos;

    public function mount()
    {
        $options = Grupo::all()->toArray();

        foreach($options as $option){
            $this->grupos[] = [
                'label' => $option['nome'],
                'value' => $option['id']
            ];
        };
    }

    public function save()
    {
        $this->validate([
            'nome' => 'required|min:3|max:255',
            'grupo_id' => 'required',
        ],
        [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no maximo 255 caracteres',
            'grupo_id.required' => 'O campo grupo é obrigatório',
        ]);

        Bandeira::create([
            'nome' => $this->nome,
            'grupo_id' => $this->grupo_id
        ]);

        $this->showModal = false;
        $this->reset('nome');
        $this->reset('grupo_id');

        redirect(route('bandeiras'))->with('success', 'Bandeira criada com sucesso');
    }

    public function openModal()
    {
        $this->showModal = true;
    }
    public function render()
    {
        return view('livewire.bandeiras.create');
    }
}
