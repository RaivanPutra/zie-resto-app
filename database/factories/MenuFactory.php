<?php 
namespace Database\Factories;

use App\Models\Menu;
use App\Models\Jenis;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jenis = Jenis::inRandomOrder()->first(); // Ambil jenis acak dari database

        if (!$jenis) {
            $jenis = Jenis::factory()->create(); // Jika tidak ada jenis, buat jenis baru
        }

        return [
            'jenis_id' => $jenis->id,
            'nama_menu' => $this->faker->word,
            'harga' => $this->faker->randomFloat(2, 10, 100), // Contoh harga antara 10 dan 100
            'image' => $this->faker->imageUrl(),
            'deskripsi' => $this->faker->sentence,
        ];
    }
}
