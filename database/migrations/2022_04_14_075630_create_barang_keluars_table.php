<?php

use App\Models\User;
use App\Models\Barang;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Barang::class)->references('id')->on('barang')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(User::class)->constrained('pengguna');
            $table->integer('jumlah_keluar');
            $table->integer('stok_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_keluars');
    }
}
