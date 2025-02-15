<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bandeira;
use App\Models\Grupo;

class BandeiraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grupo::all()->each(function ($grupo) {
            Bandeira::factory()->count(2)->create(['grupo_id' => $grupo->id]);
        });
    }
}
