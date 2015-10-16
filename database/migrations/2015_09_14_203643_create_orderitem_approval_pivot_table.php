<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderitemApprovalPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('orderitem_approval');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Schema::create('orderitem_approval', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('approval_id')->unsigned();
            $table->foreign('approval_id')->references('id')->on('approvals')->onDelete('cascade');
            $table->integer('orderitem_id')->unsigned();
            $table->foreign('orderitem_id')->references('id')->on('orderitems')->onDelete('cascade');
            $table->integer('approval_user_id')->unsigned();
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
        Schema::dropIfExists('orderitem_approval');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');    }
}
