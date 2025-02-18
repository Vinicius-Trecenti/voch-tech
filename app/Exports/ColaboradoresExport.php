<?php

namespace App\Exports;

use App\Models\Colaborador;
use Maatwebsite\Excel\Concerns\FromCollection;

class ColaboradoresExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Colaborador::all();
    }

    public function headings(): array
    {
        return ['Nome', 'Email', 'CPF', 'Unidade', 'Criado em', 'Atualizado em'];
    }
}
