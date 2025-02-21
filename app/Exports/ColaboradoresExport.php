<?php

namespace App\Exports;

use App\Models\Colaborador;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ColaboradoresExport implements FromCollection, WithHeadings
{
    protected $filtros;

    public function __construct($filtros = null)
    {
        $this->filtros = json_decode(urldecode($filtros), true);
    }

    public function collection()
    {
        $query = Colaborador::query();

        if (!empty($this->filtros['unidade'])) {
            $query->where('unidade_id', $this->filtros['unidade']);
        }

        if (!empty($this->filtros['colaborador'])) {
            $query->where('id', $this->filtros['colaborador']);
        }

        if (!empty($this->filtros['ordenacao'])) {
            $query->orderBy($this->filtros['ordenacao'], 'asc');
        }

        return $query->get();
    }
    public function headings(): array
    {
        return ['ID', 'Nome', 'Email', 'CPF', 'Unidade', 'Criado em', 'Atualizado em'];
    }
}
