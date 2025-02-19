<?php

namespace App\Http\Controllers;

use App\Exports\BandeirasExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ColaboradoresExport;
use App\Exports\GruposExport;
use App\Exports\UnidadesExport;

class RelatoriosConroller extends Controller
{
    public function export($tipo)
    {
        switch ($tipo) {
            case 'colaboradores':
                return Excel::download(new ColaboradoresExport(), 'colaboradores.xlsx');
                break;
            case 'unidades':
                return Excel::download(new UnidadesExport(), 'unidades.xlsx');
                break;
            case 'bandeiras':
                return Excel::download(new BandeirasExport(), 'bandeiras.xlsx');
                break;
            case 'grupos':
                return Excel::download(new GruposExport(), 'grupos.xlsx');
                break;
        }
    }

    public function exportComFiltros($tipo, $filtros)
    {
        switch ($tipo) {
            case 'colaboradores':
                return Excel::download(new ColaboradoresExport($filtros), 'colaboradores.xlsx');
                break;
            case 'unidades':
                return Excel::download(new UnidadesExport($filtros), 'unidades.xlsx');
                break;
            case 'bandeiras':
                return Excel::download(new BandeirasExport($filtros), 'bandeiras.xlsx');
                break;
            case 'grupos':
                return Excel::download(new GruposExport($filtros), 'grupos.xlsx');
                break;
        }
    }
}
