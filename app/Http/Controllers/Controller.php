<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function getLastID($model)
    {
        $lastID = $model::orderBy('id', 'desc')->first();
        if ($lastID) {
            if ($model == 'App\Models\User') {
                $lastID = $lastID->kode_pengguna;
            } elseif ($model == 'App\Models\Barang') {
                $lastID = $lastID->kode_barang;
            } elseif ($model == 'App\Models\BarangMasuk') {
                $lastID = $lastID->kode_barang_masuk;
            } elseif ($model == 'App\Models\BarangKeluar') {
                $lastID = $lastID->kode_barang_keluar;
            } elseif ($model == 'App\Models\Pesanan') {
                $lastID = $lastID->kode_pesanan;
            } elseif ($model == 'App\Models\MetodeBayar') {
                $lastID = $lastID->kode_metode_bayar;
            } else {
                return 'Error';
            }
            ++$lastID;
        } else {
            if ($model == 'App\Models\User') {
                $lastID = 'USR0001';
            } elseif ($model == 'App\Models\Barang') {
                $lastID = 'BR0001';
            } elseif ($model == 'App\Models\BarangMasuk') {
                $lastID = 'BRM'.date('Ymd').'0001';
            } elseif ($model == 'App\Models\BarangKeluar') {
                $lastID = 'BRK'.date('Ymd').'0001';
            } elseif ($model == 'App\Models\Pesanan') {
                $lastID = 'ORD'.date('dmY').'0001';
            } elseif ($model == 'App\Models\MetodeBayar') {
                $lastID = 'MB0001';
            } else {
                return 'Error';
            }
        }
        return $lastID;
    }
}
