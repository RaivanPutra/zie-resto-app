<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jenis;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data jenis menu McDonald's
        $jenisMenu = [
            'Sarapan Pagi',
            'Daging Sapi',
            'Ayam',
            'Minuman',
            'Makanan Penutup',
            'Cemilan'
        ];

        // Loop untuk membuat 10 data jenis berdasarkan data di atas
        foreach ($jenisMenu as $jenis) {
            Jenis::create([
                'nama_jenis' => $jenis,
            ]);
        }
    }
}
