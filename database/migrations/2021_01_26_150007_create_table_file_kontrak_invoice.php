<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFileKontrakInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_kontrak_invoice', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("id_kontrak")->references("id")->on("kontrak");
            $table->text("original_name");
            $table->text("file_name");
            $table->foreignUuid("created_by")->references("id")->on("users");
            $table->foreignUuid("updated_by")->references("id")->on("users");
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
        Schema::dropIfExists('file_kontrak_invoice');
    }
}
