<?php

namespace App\Livewire\Bandeiras;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Grupo;
use App\Models\Bandeira;

class Index extends Component
{
    use WithPagination;

    public ?int $quantity = 10;

    public ?string $search = null;

    public array $headers = [
        ['index' => 'id', 'label' => 'ID'],
        ['index' => 'nome', 'label' => 'Nome'],
        ['index' => 'grupo.nome', 'label' => 'Grupo Econômico'],
        ['index' => 'created_at', 'label' => 'Criado em'],
        ['index' => 'updated_at', 'label' => 'Atualizado em'],
        ['index' => 'actions', 'label' => 'Ações'],
    ];

    public $showModalEdit = false;

    public $showModalDelete = false;

    public $nome;

    public $grupos;

    public $grupo_id;

    public $bandeira;

    public function mount(){
        $options = Grupo::all()->toArray();

        foreach($options as $option){
            $this->grupos[] = [
                'label' => $option['nome'],
                'value' => $option['id']
            ];
        };
    }

    public function openModalEdit($row)
    {
        $this->bandeira = $row;
        $this->grupo_id = $row['grupo_id'];
        $this->nome = $row['nome'];
        $this->showModalEdit = true;
    }

    public function edit(){

        $this->validate([
            'nome' => 'required|min:3',
            'grupo_id' => 'required',
        ],[
            'nome.required' => 'O campo nome é obrigatório',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'grupo_id.required' => 'O campo grupo é obrigatório',
        ]);

        $bandeira = Bandeira::where('id', $this->bandeira['id'])->first();

        $bandeira->update([
            'nome' => $this->nome,
            'grupo_id' => $this->grupo_id
        ]);

        $this->showModalEdit = false;
        $this->reset('nome');
        $this->reset('grupo_id');

        redirect(route('bandeiras'))->with('success', 'Bandeira atualizada com sucesso');
    }

    public function openModalDelete($row)
    {
        $this->bandeira = $row;
        $this->nome = $row['nome'];
        $this->showModalDelete = true;
    }

    public function delete(){
        $bandeira = Bandeira::where('id', $this->bandeira['id'])->first();
        $bandeira->delete();
        $this->showModalDelete = false;

        $this->reset('nome');

        redirect(route('bandeiras'))->with('success', 'Bandeira deletada com sucesso');
    }

    public function render()
    {
        return view('livewire.bandeiras.index', [
            'rows' => Bandeira::query()
                ->when($this->search, function (Builder $query) {

                    return $query->where('nome', 'like', "%{$this->search}%")
                    ->orWhere('created_at', 'like', "%{$this->search}%")
                    ->orWhere('updated_at', 'like', "%{$this->search}%")
                    ->orWhereHas('grupo', function (Builder $query) {
                        return $query->where('nome', 'like', "%{$this->search}%");
                    });
                })
                ->paginate($this->quantity)

        ]);
    }
}
