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
			$table->increments('id');
			$table->timestamp('exchange_date');
			$table->integer('currency_code')->unsigned()->index();
            $table->foreign('currency_code')->references('currency_code')->on('currencies')->onDelete('cascade');
			$table->decimal('currency_value', 12,6);
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
