<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class BarangMasukExportAll implements FromCollection, WithMapping, WithHeadings, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BarangMasuk::all();
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 15,   
            'C' => 15,   
            'D' => 15,   
            'E' => 15,   
            'F' => 15,   
        ];
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama Barang',
            'Jumlah Masuk',
            'Stok Akhir',
            'Satuan',
            'Produsen'
        ];
    }

    public function map($data): array
    {
        return [
            $data->created_at,
            $data->barang->nama,
            $data->jumlah_masuk,
            $data->stok_akhir,
            $data->barang->satuan,
            $data->user->nama 
        ];
    }
}
