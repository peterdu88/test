<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('approvals');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Schema::create('approvals',function(Blueprint $table){
            $table->increments('id');
            $table->text('name');
            $table->boolean('status');
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
        Schema::dropIfExists('approvals');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
