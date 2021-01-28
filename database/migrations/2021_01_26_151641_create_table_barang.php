<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string("nama");
            $table->string('satuan');
            $table->integer("jumlah");
            $table->decimal("harga");
            $table->foreignUuid("id_kontrak")->references("id")->on("kontrak");
            $table->foreignUuid("created_by")->nullable()->references("id")->on("users");
            $table->foreignUuid("updated_by")->nullable()->references("id")->on("users");
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
        Schema::dropIfExists('barang');
    }
}
