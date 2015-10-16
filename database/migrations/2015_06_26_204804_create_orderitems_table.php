<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderitemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('orderitems');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

		Schema::create('orderitems', function(Blueprint $table)
		{
            $table->engine ='InnoDB';
			$table->increments('id')->unsigned();
            $table->string('name');
            $table->mediumText('description');
            $table->text('url');
            $table->unsignedInteger('quantity')->default(0);
            $table->float('estimatedprice')->default(0.00);
            $table->float('estimatedtotal')->default(0.00);
            $table->float('fixedprice')->default(0.00);
            $table->float('fixedtotal')->default(0.00);
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->integer('vendor_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('orderitems');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
