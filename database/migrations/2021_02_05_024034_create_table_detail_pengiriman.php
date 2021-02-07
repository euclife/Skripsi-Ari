<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDetailPengiriman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pengiriman', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("id_pengiriman")->references("id")->on("pengiriman");
            $table->foreignUuid("id_barang")->references("id")->on("barang");
            $table->integer("jumlah_kirim");
            $table->foreignUuid("created_by")->references("id")->on("users");
            $table->foreignUuid("updated_by")->nullable()->references("id")->on("users");
            $table->timestamps();
        });
    }

    /**detail_pengiriman
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pengiriman');
    }
}
