<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderitemPaymentPivotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('orderitem_payment');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Schema::create('orderitem_payment', function(Blueprint $table) {
           $table->increments('id')->unsigned();
            $table->integer('payment_id')->unsigned();
            $table->integer('orderitem_id')->unsigned();
            $table->foreign('orderitem_id')->references('id')->on('orderitems')->onDelete('cascade');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('orderitem_payment');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
