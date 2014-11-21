<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_units', function(Blueprint $table)
		{
			$table->string('id',36)->primary();
			$table->string('company_code',36)->index();
			$table->foreign('company_code')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
			$table->integer('business_unit_code');
			$table->string('business_unit_name', 50);
			$table->integer('business_unit_type');
			$table->string('business_unit_account', 50);
			$table->string('business_unit_address', 50);
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
		Schema::drop('business_units');
	}

}
