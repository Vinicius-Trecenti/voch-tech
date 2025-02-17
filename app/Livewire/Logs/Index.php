<?php

namespace App\Livewire\Logs;

use Livewire\Component;
use App\Models\Audit;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public int $quantity = 5;

    public array $headers = [
        ['index' => 'id', 'label' => 'ID'],
        ['index' => 'user_id', 'label' => 'Usuário'],
        ['index' => 'evento', 'label' => 'Ação'],
        ['index' => 'data', 'label' => 'Data'],
        ['index' => 'ip', 'label' => 'IP'],
        ['index' => 'auditable_id', 'label' => 'ID auditado'],
        ['index' => 'auditable_type', 'label' => 'Tipo auditado'],
        ['index' => 'detalhes', 'label' => 'Detalhes'],
    ];

    public function render()
    {
        return view('livewire.logs.index', [
            'rows' => Audit::query()
                ->when($this->search, function (Builder $query){
                    return $query->where('user_id', 'like', "%{$this->search}%")
                    ->orWhere('evento', 'like', "%{$this->search}%")
                    ->orWhere('data', 'like', "%{$this->search}%")
                    ->orWhere('ip', 'like', "%{$this->search}%")
                    ->orWhere('auditable_id', 'like', "%{$this->search}%")
                    ->orWhere('auditable_type', 'like', "%{$this->search}%")
                    ->orWhere('detalhes', 'like', "%{$this->search}%");
                })
                ->paginate($this->quantity)
        ]);
    }
}
