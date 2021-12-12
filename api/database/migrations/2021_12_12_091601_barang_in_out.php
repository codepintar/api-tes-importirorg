<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BarangInOut extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_in_out', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku');
            $table->date('tanggal');
            $table->tinyInteger('qty')->default('0');
            $table->string('is_flag');
            $table->string('created_by');
            $table->string('updated_by');
            $table->tinyInteger('is_deleted')->default('0');
            $table->timestamps();
        });
        /*Schema::table('out', function (Blueprint $table) {
            //
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_in_out', function (Blueprint $table) {
            //
        });
    }
}
