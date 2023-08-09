<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("g_number");
            $table->date("date");
            $table->date("last_change_date");
            $table->string("supplier_article");
            $table->string("tech_size");
            $table->string("barcode");
            $table->integer("total_price");
            $table->integer("discount_percent");
            $table->string("warehouse_name");
            $table->string('oblast');
            $table->bigInteger('income_id');
            $table->bigInteger("odid");
            $table->bigInteger("nm_id");
            $table->string("subject");
            $table->string("category");
            $table->string("brand");
            $table->boolean('is_cancel');
            $table->date('cancel_dt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
