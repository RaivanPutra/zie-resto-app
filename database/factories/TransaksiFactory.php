<?php

namespace Database\Factories;

use App\Models\Transaksi;
use DateTime;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransaksiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaksi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = new DateTime();
        $date->setDate(2021, 4, 18);

        return [
            'id' => "P" . sprintf('%08d', $this->faker->unique()->numberBetween(1, 99999999)),
            'tanggal' => $date->format('Y-m-d'),
            'total_harga' => $this->faker->numberBetween(1000, 100000),
            'metode_pembayaran' => 'cash',
            'keterangan' => $this->faker->sentence,
        ];
    }
}
