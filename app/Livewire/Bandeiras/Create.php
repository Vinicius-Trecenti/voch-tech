<?php

namespace App\Livewire\Bandeiras;

use App\Models\Bandeira;
use Livewire\Component;
use App\Models\Grupo;

use TallStackUi\Traits\Interactions;

class Create extends Component
{
    use Interactions;

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

        $status = Bandeira::create([
            'nome' => $this->nome,
            'grupo_id' => $this->grupo_id
        ]);

        $this->showModal = false;
        $this->reset('nome');
        $this->reset('grupo_id');

        ($status) ?
        $this->toast()->timeout(seconds: 5)->success('Sucesso', 'A bandeira foi criada com sucesso')->flash()->send() :
        $this->toast()->timeout(seconds: 5)->error('Erro', 'Ocorreu um erro ao criar a bandeira')->flash()->send();

        redirect(route('bandeiras'));
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
