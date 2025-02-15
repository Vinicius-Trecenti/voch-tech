<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Colaborador;
use App\Models\Unidade;

class ColaboradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unidade::all()->each(function ($unidade) {
            Colaborador::factory()->count(3)->create(['unidade_id' => $unidade->id]);
        });
    }
}
