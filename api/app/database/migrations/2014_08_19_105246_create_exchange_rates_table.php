<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExchangeRatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exchange_rates', function(Blueprint $table)
		{
			$table->string('id',36)->primary();
			$table->timestamp('exchange_date');
			$table->string('currency_code',36)->index();
            $table->foreign('currency_code')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
			$table->decimal('currency_value', 12,6);
            $table->string('user',36)->index();
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
		Schema::drop('exchange_rates');
	}

}
