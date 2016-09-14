<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCieloOrdersTable extends Migration {

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

            $table->text('body')->nullable();
            $table->text('notification')->nullable();

            $table->unsignedInteger('payment_status');

            $table->string('payable_type');
            $table->string('payable_id');
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
		Schema::drop('cielo_orders');
	}

}
