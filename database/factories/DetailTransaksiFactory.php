<?php

namespace Database\Factories;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Models\Menu;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailTransaksiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailTransaksi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id_jual = $this->faker->randomElement(
            Transaksi::select('id')
                ->whereIn('tanggal', ['2021-04-18'])
                ->get()
        );

        $id = $this->faker->randomElement(
            Menu::select('id')
                ->get()
        );

        $harga = Menu::select('harga')
            ->where('id', $id)
            ->first();

        if (!$harga) {
            // Handle the case where $harga is null
            $harga = ['jumlah' => $this->faker->numberBetween(10, 100)]; // Example default harga
        }

        $jumlah = $this->faker->numberBetween(1, 20);

        return [
            'transaksi_id' => $id_jual,
            'menu_id' => $id,
            'jumlah' => $jumlah,
            'subtotal' => $harga['jumlah'] * $jumlah,
        ];
    }
}
