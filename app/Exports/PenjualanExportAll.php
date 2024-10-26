<?php

namespace App\Exports;

use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;


class PenjualanExportAll implements FromCollection, WithMapping, WithHeadings, WithColumnWidths, WithCalculatedFormulas, WithEvents
{

    use RegistersEventListeners;
    public function collection()
    {
        return Pesanan::all();
    }

    public function map($data): array
    {
        return [
            $data->created_at,
            $data->nama_pemesan,
            $data->metode_pembayaran,
            $data->total_harga,
        ];
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama Pelanggan',
            'Metode Pembayaran',
            'Total Harga',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 25,
            'C' => 25,
            'D' => 25,
        ];
    }

    public static function afterSheet(AfterSheet $event)
    {
        $cellRange = 'A1:D1'; // All headers
        $styleArray = [
            'font' => [
                'name'      =>  'Calibri',
                'size'      =>  11,
                'bold'      =>  false,
                'color' => ['argb' => 'FFFFFF'],
            ],
            //Set background style
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '000000',
                ]
            ],
        ];
        $total = Pesanan::sum('total_harga');
        $event->sheet->appendRows(array(
            array('Total', $total),
        ), $event);
        $event->sheet->getDelegate()->getStyle($cellRange);
    }
}
