<?php

namespace App\Livewire\Relatorios;

use App\Exports\ColaboradoresExport;
use App\Jobs\ExportColaboradoresJob;
use Livewire\Component;
use TallStackUi\Traits\Interactions;


use App\Models\Grupo;
use App\Models\Bandeira;
use App\Models\Unidade;
use App\Models\Colaborador;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use Interactions;

    public $tipo;

    public $grupo = null;
    public $grupos;

    public $bandeira = null;
    public $bandeiras;

    public $unidade = null;
    public $unidades;

    public $colaborador = null;
    public $colaboradores;

    public $ordenacao = 'id';

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

        $this->toast()->info('Relatório sendo gerado', 'Aguarde alguns segundos')->send();

        if($this->grupo == null && $this->bandeira == null && $this->unidade == null && $this->colaborador == null && $this->ordenacao == 'id') {
            redirect(route('relatorios.export', ['tipo' => $this->tipo]));
        }
        else{
            $filtros = [
                'grupo' => $this->grupo,
                'bandeira' => $this->bandeira,
                'unidade' => $this->unidade,
                'colaborador' => $this->colaborador,
                'ordenacao' => $this->ordenacao,
            ];

            redirect(route('relatorios.export.filtros', [
                'tipo' => $this->tipo,
                'filtros' => urlencode(json_encode($filtros))
            ]));
        }
    }

    public function render()
    {
        return view('livewire.relatorios.index');
    }
}
