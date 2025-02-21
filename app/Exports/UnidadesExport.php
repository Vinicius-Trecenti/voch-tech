<?php

namespace App\Exports;

use App\Models\Unidade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UnidadesExport implements FromCollection, WithHeadings
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
        $query = Unidade::query();

        if (!empty($this->filtros['bandeira'])) {
            $query->where('bandeira_id', $this->filtros['bandeira']);
        }

        if (!empty($this->filtros['unidade'])) {
            $query->where('unidade_id', $this->filtros['unidade']);
        }

        if (!empty($this->filtros['ordenacao'])) {
            if($this->filtros['ordenacao'] == 'nome') {
                $this->filtros['ordenacao'] = 'nome_fantasia';
            }
            $query->orderBy($this->filtros['ordenacao'], 'asc');
        }

        return $query->get();
    }

    public function headings(): array
    {
        return ['ID', 'Unidade', 'Bandeira', 'Criado em', 'Atualizado em'];
    }
}
