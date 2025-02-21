<?php

namespace App\Exports;

use App\Models\Bandeira;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BandeirasExport implements FromCollection, WithHeadings
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
        $query = Bandeira::query();

        if (!empty($this->filtros['grupo'])) {
            $query->where('grupo_id', $this->filtros['grupo']);
        }

        if (!empty($this->filtros['bandeira'])) {
            $query->where('bandeira_id', $this->filtros['bandeira']);
        }

        if (!empty($this->filtros['ordenacao'])) {
            $query->orderBy($this->filtros['ordenacao'], 'asc');
        }

        return $query->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nome', 'Grupo', 'Criado em', 'Atualizado em'];
    }
}
