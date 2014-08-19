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
			$table->increments('id');
			$table->string('company_code', 5);
			$table->string('company_name', 70);
			$table->string('company_short_name', 30);
			$table->string('company_address', 50);
			$table->integer('municipality_code')->unsigned()->index();
            $table->foreign('municipality_code')->references('municipality_code')->on('municipality')->onDelete('cascade');
			$table->integer('settlement_code')->unsigned()->index();
            $table->foreign('settlement_code')->references('settlement_code')->on('settlements')->onDelete('cascade');
			$table->integer('street_code')->unsigned()->index();
            $table->foreign('street_code')->references('street_code')->on('streets')->onDelete('cascade');
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
