<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Unidade;
use App\Models\Bandeira;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unidade>
 */
class UnidadeFactory extends Factory
{
    protected $model = Unidade::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome_fantasia' => $this->faker->company,
            'razao_social' => $this->faker->company . ' LTDA',
            'cnpj' => $this->faker->numerify('##.###.###/####-##'),
            'bandeira_id' => Bandeira::factory(),
        ];
    }
}
