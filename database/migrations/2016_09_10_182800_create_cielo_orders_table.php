<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cielo_orders', function(Blueprint $table)
		{
		    $table->string('order_id');
            $table->primary('order_id');

            $table->text('order');
            $table->text('notification');

            $table->unsignedInteger('payment_status');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cielo_orders');
	}

}
