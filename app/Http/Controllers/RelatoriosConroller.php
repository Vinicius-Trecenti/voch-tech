<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ColaboradoresExport;

class RelatoriosConroller extends Controller
{
    public function exportColaboradores(){

        return Excel::download(new ColaboradoresExport(), 'colaboradores.xlsx');

    }
}
