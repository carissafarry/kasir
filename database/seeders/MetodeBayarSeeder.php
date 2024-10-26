<?php

namespace Database\Seeders;

use App\Models\MetodeBayar;
use Illuminate\Database\Seeder;

class MetodeBayarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MetodeBayar::create([
            'kode_metode_bayar' => 'MB001',
            'nama' => 'Tunai',
        ]);
        MetodeBayar::create([
            'kode_metode_bayar' => 'MB002',
            'nama' => 'Dana',
        ]);
        MetodeBayar::create([
            'kode_metode_bayar' => 'MB003',
            'nama' => 'BCA Transfer',
        ]);
    }
}
