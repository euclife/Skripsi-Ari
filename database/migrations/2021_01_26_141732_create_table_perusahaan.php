<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePerusahaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("nama");
            $table->text("alamat");
            $table->text("nomor_telepon");
            $table->text("nomor_fax")->nullable();
            $table->text("website")->nullable();
            $table->text("provinsi");
            $table->text("kota");
            $table->text("kode_pos");
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
        Schema::dropIfExists('perusahaan');
    }
}
