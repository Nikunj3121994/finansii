<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCalculationDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('calculation_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('calculation_header_id')->unsigned()->index();
			$table->foreign('calculation_header_id')->references('id')->on('calculation_headers')->onDelete('cascade')->onUpdate('cascade');
			$table->integer('article_id')->unsigned()->index();
			$table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade')->onUpdate('cascade');
			$table->decimal('quantity', 15,4);
			$table->decimal('rabat', 5,2);
			$table->decimal('price_input1', 15,4);
            $table->decimal('price_input2', 15,4);
			$table->decimal('tariff_rate_input', 5,2);
			$table->decimal('tax_input', 15,4);
			$table->decimal('tax_output', 15,4);
			$table->decimal('margin', 7,2);
			$table->decimal('price_output1', 15,4);
			$table->decimal('price_output2',15,4);
			$table->integer('tariff_code');
			$table->string('debit_credit', 1);
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
		Schema::drop('calculation_details');
	}

}
