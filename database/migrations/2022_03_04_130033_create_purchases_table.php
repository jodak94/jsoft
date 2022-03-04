<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('provider_id');
            $table->string('provider_ruc');
            $table->string('provider_business_name');
            $table->string('invoice_number');
            $table->string('invoice_type');
            $table->integer('credit_term');
            $table->decimal('total_amount',20,6);
            $table->decimal('total_tax',20,6);
            $table->string('total_amount_in_letters');
            $table->boolean('cancelled');
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
        Schema::dropIfExists('purchases');
    }
}
