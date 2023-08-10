<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->string("last_change_date");
            $table->string("supplier_article");
            $table->string("tech_size");
            $table->bigInteger("barcode");
            $table->integer("quantity");
            $table->boolean("is_supply");
            $table->boolean("is_realization");
            $table->integer("quantity_full");
            $table->string("warehouse_name");
            $table->integer("in_way_to_client");
            $table->integer("in_way_from_client");
            $table->bigInteger("nm_id");
            $table->string("subject");
            $table->string("category");
            $table->string("brand");
            $table->string("sc_code");
            $table->integer("price");
            $table->integer("discount");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
