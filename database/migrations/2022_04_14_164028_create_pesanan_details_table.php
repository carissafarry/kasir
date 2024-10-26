<?php

use App\Models\Barang;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesananDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pesanan::class)->references('id')->on('pesanan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Barang::class)->references('id')->on('barang')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('qty');
            $table->integer('subtotal');
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('pesanan_details');
    }
}
