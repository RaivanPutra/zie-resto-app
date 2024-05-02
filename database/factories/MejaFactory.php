<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Meja;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meja>
 */
class MejaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Meja::class;

    public function definition(): array
    {
        return [
            'no_meja' => $this->faker->unique()->numberBetween(1, 10), // Membuat no meja secara acak
            'kapasitas' =>$this->faker->randomElement(['2', '6', '8']),
            'status' =>$this->faker->randomElement(['kosong', 'terisi']),
        ];
    }
}
