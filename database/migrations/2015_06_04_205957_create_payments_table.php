<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('payments');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Schema::create('payments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('description');
            $table->boolean('status');
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
        Schema::dropIfExists('payments');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
