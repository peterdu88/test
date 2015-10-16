<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVendorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('vendors');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

		Schema::create('vendors', function(Blueprint $table)
		{
            $table->engine ='InnoDB';
			$table->increments('id')->unsigned();
            $table->string('name');
            $table->string('contact');
            $table->string('phone');
            $table->string('fax');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->integer('country_id');
            $table->string('zipcode');
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
        Schema::dropIfExists('vendors');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
