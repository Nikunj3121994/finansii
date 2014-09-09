<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFieldToCalculationHeadersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('calculation_headers', function(Blueprint $table)
		{
            $table->boolean('archived');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('calculation_headers', function(Blueprint $table)
		{
			$table->dropColumn('archived');
		});
	}

}
