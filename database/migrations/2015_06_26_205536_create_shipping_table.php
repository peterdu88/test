<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShippingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('shipping');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

		Schema::create('shipping', function(Blueprint $table)
		{
            $table->engine ='InnoDB';
            $table->increments('id')->unsigned();
            $table->string('shipping_method');
            $table->unsignedInteger('orderitem_id')->unique();
            $table->foreign('orderitem_id')->references('id')->on('orderitems')->onDelete('cascade');
            $table->string('track_number');
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
        Schema::dropIfExists('shipping');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
