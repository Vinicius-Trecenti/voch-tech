<?php

namespace App\Livewire\Relatorios;

use App\Jobs\ExportColaboradoresJob;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

use App\Models\Grupo;
use App\Models\Bandeira;
use App\Models\Unidade;
use App\Models\Colaborador;

class Index extends Component
{
    use Interactions;

    public $tipo;

    public $grupo;
    public $grupos;

    public $bandeira;
    public $bandeiras;

    public $unidade;
    public $unidades;

    public $colaborador;
    public $colaboradores;

    public $ordenacao;

    public function mount()
    {
        $this->grupos = Grupo::all()->map(function ($grupo) {
            return [
                'label' => $grupo->nome,
                'value' => $grupo->id,
            ];
        });
        $this->bandeiras = Bandeira::all()->map(function ($bandeira) {
            return [
                'label' => $bandeira->nome,
                'value' => $bandeira->id,
            ];
        });

        $this->unidades = Unidade::all()->map(function ($unidade) {
            return [
                'label' => $unidade->nome_fantasia,
                'value' => $unidade->id,
            ];
        });

        $this->colaboradores = Colaborador::all()->map(function ($colaborador) {
            return [
                'label' => $colaborador->nome,
                'value' => $colaborador->id,
            ];
        });
    }

    public function gerar()
    {
        $this->validate([
            'tipo' => 'required',
        ], [
            'tipo.required' => 'O campo tipo de relatório é obrigatório',
        ]);

        ExportColaboradoresJob::dispatch();

        $this->toast()->info('Relatório sendo gerado', 'Aguarde alguns segundos')->send();

        redirect(route('relatorios.colaboradores.export'));
    }


    public function render()
    {
        return view('livewire.relatorios.index');
    }
}
