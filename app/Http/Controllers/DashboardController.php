<?php

namespace App\Http\Controllers;

use App\Models\Bandeira;
use App\Models\Colaborador;
use Illuminate\Http\Request;

use App\Models\Unidade;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $dados = Unidade::with('colaboradores')->get()
            ->map(function ($unidade) {
                return [
                    'unidade' => $unidade->nome_fantasia,
                    'colaboradores' => $unidade->colaboradores->count(),
                ];
            });

        $colaboradores = Colaborador::all()->count();

        $unidades = Unidade::all()->count();

        $bandeiras = Bandeira::all()->count();

        return view('dashboard', compact('dados', 'colaboradores', 'unidades', 'bandeiras'));
    }
}
