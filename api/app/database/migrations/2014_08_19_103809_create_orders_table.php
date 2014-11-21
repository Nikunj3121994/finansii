<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->string('id',36)->primary();
			$table->string('order_type',36)->index();
            $table->foreign('order_type')->references('id')->on('order_types')->onDelete('cascade')->onUpdate('cascade');
			$table->string('order_number',20);
			$table->timestamp('order_date');
			$table->timestamp('order_booking');
			$table->string('company_code',36)->index();
            $table->foreign('company_code')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->string('user')->index();
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
		Schema::drop('orders');
	}

}
