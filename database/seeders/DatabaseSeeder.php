<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            JenisSeeder::class,
            MenuSeeder::class,
            StokSeeder::class,
            MemberSeeder::class,
            MejaSeeder::class,
            UserSeeder::class,
        ]);

        // Transaksi::factory()->count(5)->create();
        // DetailTransaksi::factory()->count(10)->create();
    }
}
