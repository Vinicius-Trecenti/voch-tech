<?php

namespace App\Exports;

use App\Models\Grupo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GruposExport implements FromCollection, WithHeadings
{
    protected $filtros;

    public function __construct($filtros = null)
    {
        $this->filtros = json_decode(urldecode($filtros), true);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Grupo::query();

        if (!empty($this->filtros['grupo'])) {
            $query->where('grupo_id', $this->filtros['grupo']);
        }

        if (!empty($this->filtros['ordenacao'])) {
            $query->orderBy($this->filtros['ordenacao']);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nome', 'Criado em', 'Atualizado em'];
    }
}
