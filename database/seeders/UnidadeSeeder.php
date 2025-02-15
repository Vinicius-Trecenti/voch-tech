<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unidade;
use App\Models\Bandeira;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bandeira::all()->each(function ($bandeira) {
            Unidade::factory()->count(2)->create(['bandeira_id' => $bandeira->id]);
        });
    }
}
