<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('comments');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Schema::create('comments',function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('orderitem_id')->index();
            $table->foreign('orderitem_id')->references('id')->on('orderitems')->onDelete('cascade');
            $table->longText('content');
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
		//
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('comments');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

	}

}
