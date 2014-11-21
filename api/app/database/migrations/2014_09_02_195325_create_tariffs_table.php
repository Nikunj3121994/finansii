<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTariffsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tariffs', function(Blueprint $table)
		{
			$table->string('id',36)->primary();
			$table->integer('tariff_code');
			$table->string('tariff_rate', 5);
			$table->string('tariff_name', 30);
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
		Schema::drop('tariffs');
	}

}
