<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stok;
use App\Models\Menu;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data stok sesuai dengan data menu yang sudah ada
        $dataStok = [
            ['menu_id' => 1, 'jumlah' => 10],
            ['menu_id' => 2, 'jumlah' => 15],
            ['menu_id' => 3, 'jumlah' => 12],
            ['menu_id' => 4, 'jumlah' => 12],
            ['menu_id' => 5, 'jumlah' => 5],
            ['menu_id' => 6, 'jumlah' => 7],
            ['menu_id' => 7, 'jumlah' => 12],
            ['menu_id' => 8, 'jumlah' => 10],
            ['menu_id' => 9, 'jumlah' => 13],
            ['menu_id' => 10, 'jumlah' => 12],
            ['menu_id' => 11, 'jumlah' => 15],
            ['menu_id' => 12, 'jumlah' => 20],
        ];

        // Loop untuk menyimpan data stok ke dalam database
        foreach ($dataStok as $stok) {
            Stok::create([
                'menu_id' => $stok['menu_id'],
                'jumlah' => $stok['jumlah'],
            ]);
        }
    }
}
