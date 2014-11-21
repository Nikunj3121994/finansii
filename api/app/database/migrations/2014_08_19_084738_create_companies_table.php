<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table)
		{
			$table->string('id',36)->primary();
			$table->integer('company_code');
			$table->string('company_name', 70);
			$table->string('company_short_name', 30);
			$table->string('company_address', 50);
			$table->string('municipality_code',36)->index();

			$table->string('settlement_code',36)->index();

			$table->string('street_code',36)->index();

			$table->string('telephone1', 20);
			$table->string('telephone2', 20);
			$table->string('fax', 20);
			$table->string('mail', 70);
			$table->string('owner', 50);
			$table->string('authorized', 50);
			$table->string('activity', 20);
			$table->integer('id_number');
			$table->string('tax_code', 30);
			$table->string('tax_payer', 2);
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
		Schema::drop('companies');
	}

}
