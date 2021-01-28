<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKontrak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrak', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("id_perusahaan")->references("id")->on("perusahaan");
            $table->text("tentang");
            $table->text("nomor");
            $table->date('tanggal_surat_pesanan');
            $table->date('tanggal_serah_terima_barang');
            $table->foreignUuid("created_by")->references("id")->on("users");
            $table->foreignUuid("updated_by")->nullable()->references("id")->on("users");
            $table->foreignUuid("deleted_by")->nullable()->references("id")->on("users");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kontrak');
    }
}
