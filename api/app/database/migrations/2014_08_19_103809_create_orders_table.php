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
			$table->increments('id');
			$table->integer('order_type')->unsigned()->index();
            $table->foreign('order_type')->references('order_type')->on('order_types')->onDelete('cascade')->onUpdate('cascade');
			$table->integer('order_number');
			$table->timestamp('order_date');
			$table->timestamp('order_booking');
			$table->integer('company_code')->unsigned()->index();
            $table->foreign('company_code')->references('company_code')->on('companies')->onDelete('cascade')->onUpdate('cascade');
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
