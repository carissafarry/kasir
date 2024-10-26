<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class BarangMasukExport implements FromQuery, WithMapping, WithHeadings, WithColumnWidths
{   
    
    public function __construct($dari = '', $sampai = '')
    {
        $this->dari = $dari;
        $this->sampai = $sampai;
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

    public function query()
    {
        return BarangMasuk::query()
            ->whereDate('created_at', '>=', $this->dari ? $this->dari : DB::raw('CURDATE()'))
            ->whereDate('created_at', '<=', $this->sampai ? $this->sampai : DB::raw('CURDATE()'));
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
