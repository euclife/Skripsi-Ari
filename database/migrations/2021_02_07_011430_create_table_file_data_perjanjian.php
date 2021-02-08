<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFileDataPengiriman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_kontrak_perjanjian', function (Blueprint $table) {
            $table->uuid("id")->primary();
//            $table->foreignUuid("id_kontrak")->references("id")->on("perj");
            $table->text("original_name");
            $table->text("file_name");
            $table->foreignUuid("created_by")->references("id")->on("users");
            $table->foreignUuid("updated_by")->nullable()->references("id")->on("users");
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
        Schema::dropIfExists('file_kontrak_perjanjian');
    }
}
