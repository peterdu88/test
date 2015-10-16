<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('categories');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

		Schema::create('categories', function(Blueprint $table)
		{
            $table->engine ='InnoDB';
			$table->increments('id')->unsigned();
            $table->string('name');
            $table->text('description');
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
        Schema::dropIfExists('categories');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
