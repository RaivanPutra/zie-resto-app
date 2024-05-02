<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data menu McDonald's beserta jenis ID
        $dataMenu = [
            ['jenis_id' => 1, 'nama_menu' => 'Egg and Cheese Muffin', 'harga' => 20000, 'image' => 'burger2.jpeg', 'deskripsi' => 'Perpaduan scrambled egg dan keju gurih dalam setangkup English Muffin hangat.'],
            ['jenis_id' => 1, 'nama_menu' => 'Chicken Muffin', 'harga' => 15000, 'image' => 'burger3.jpeg', 'deskripsi' => 'Setangkup English muffin hangat dilapis saus mayonais dengan daging ayam olahan yang digoreng dengan sempurna.'],
            ['jenis_id' => 2, 'nama_menu' => 'Double Cheeseburger', 'harga' => 20000, 'image' => 'burger4.jpeg', 'deskripsi' => 'Burger ganda dengan dua patty daging sapi dan keju.'],
            ['jenis_id' => 2, 'nama_menu' => 'Big Mac', 'harga' => 25000, 'image' => 'burger5.jpeg', 'deskripsi' => 'Burger ikonik dengan daging sapi, saus spesial, selada, keju, dan acar.'],
            ['jenis_id' => 3, 'nama_menu' => 'Korean Soy Garlic Wings - A la Carte 6pcs', 'harga' => 35000, 'image' => 'korean-soy.jpeg', 'deskripsi' => 'Nikmati menu A la Carte Korean Soy Garlic Wings. Dengan enam potongan sayap (Wingette & Drummette) dengan cita rasa Korean Soy Garlic yang renyah, gurih, dan lezat.'],
            ['jenis_id' => 3, 'nama_menu' => 'PaNas 2 Ayam Gulai', 'harga' => 30000, 'image' => 'panas.jpeg', 'deskripsi' => '2 potong Ayam yang disajikan dengan Gulai. Lengkap dengan Nasi dan Fruit Tea Cocopandan yang menyegarkan. Tersedia pilihan Krispy/Spicy dengan Nasi Putih/Nasi Uduk'],
            ['jenis_id' => 4, 'nama_menu' => 'Fruit Tea Lemon', 'harga' => 8000, 'image' => 'fruitea.jpeg', 'deskripsi' => 'Teh rasa buah lemon yang segar'],
            ['jenis_id' => 4, 'nama_menu' => 'Sprite', 'harga' => 8000, 'image' => 'sprite.jpeg', 'deskripsi' => 'Minuman berkarbonasi dengan rasa perpaduan lemon lime dan soda'],
            ['jenis_id' => 5, 'nama_menu' => 'Blueberry Cheesecake Pie', 'harga' => 9500, 'image' => 'pie2.jpeg', 'deskripsi' => 'Nikmati Blueberry Jam yang dipadu dengan Cream Cheese lembut dalam balutan pie hangat dan renyah.'],
            ['jenis_id' => 5, 'nama_menu' => 'Cokelat Strawberry Sundae', 'harga' => 11000, 'image' => 'eskrim.jpeg', 'deskripsi' => 'Soft ice cream favorit dengan cita rasa cokelat dengan pilihan topping saus strawberry.'],
            ['jenis_id' => 6, 'nama_menu' => 'Sweet Corn', 'harga' => 10000, 'image' => 'jagung.jpeg', 'deskripsi' => 'Bulir jagung yang direbus hingga menghasilkan rasa manis yang alami dan bernutrisi'],
            ['jenis_id' => 6, 'nama_menu' => 'French Fries', 'harga' => 11000, 'image' => 'kentang.jpeg', 'deskripsi' => 'Kentang goreng renyah dan gurih'],
            // Tambahkan data menu lainnya sesuai kebutuhan
        ];

        // Loop untuk menyimpan data menu ke dalam database
        foreach ($dataMenu as $menu) {
            Menu::create([
                'jenis_id' => $menu['jenis_id'],
                'nama_menu' => $menu['nama_menu'],
                'harga' => $menu['harga'],
                'image' => $menu['image'],
                'deskripsi' => $menu['deskripsi'],
            ]);
        }
    }
}
