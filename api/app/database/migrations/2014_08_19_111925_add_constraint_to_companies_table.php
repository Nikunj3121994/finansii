<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddConstraintToCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('companies', function(Blueprint $table)
		{
            $table->foreign('municipality_code')->references('id')->on('municipalities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('settlement_code')->references('id')->on('settlements')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('street_code')->references('id')->on('streets')->onDelete('cascade')->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('companies', function(Blueprint $table)
		{
			
		});
	}

}
