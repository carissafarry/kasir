<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Barang::create([
            'kode_barang' => 'BR0001',
            'nama' => 'Baju',
            'harga' => '10000',
            'stok' => '200',
            'satuan' => 'pcs',
            'user_id' => '2',
        ]);

        Barang::create([
            'kode_barang' => 'BR0002',
            'nama' => 'Mouse Gemink',
            'harga' => '50000',
            'stok' => '150',
            'satuan' => 'pcs',
            'user_id' => '2',
        ]);

        Barang::create([
            'kode_barang' => 'BR0003',
            'nama' => 'Keyboard',
            'harga' => '12000',
            'stok' => '145',
            'satuan' => 'pcs',
            'user_id' => '2',
        ]);
    }
}
