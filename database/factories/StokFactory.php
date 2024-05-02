<?php
namespace Database\Factories;

use App\Models\Stok;
use App\Models\Menu;
use App\Models\Jenis;
use Illuminate\Database\Eloquent\Factories\Factory;

class StokFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stok::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Ambil menu acak yang sudah ada
        $menu = Menu::inRandomOrder()->first();

        // Jika tidak ada menu yang tersedia, hentikan proses
        if (!$menu) {
            return [];
        }

        // Ambil jenis dari menu yang sudah ada
        $jenis = $menu->jenis;

        return [
            'menu_id' => $menu->id,
            'jumlah' => $this->faker->numberBetween(1, 100), // Contoh jumlah stok antara 1 dan 100
        ];
    }
}
