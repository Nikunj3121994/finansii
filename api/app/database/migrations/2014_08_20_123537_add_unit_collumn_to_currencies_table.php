<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUnitCollumnToCurrenciesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('currencies', function(Blueprint $table)
		{
			$table->integer('currency_unit');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('currencies', function(Blueprint $table)
		{
            $table->dropColumn('currency_unit');
		});
	}

}
