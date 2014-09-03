<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePartnersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('partners', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('partner_code')->unsigned()->index();
			$table->string('partner_name', 50);
			$table->string('partner_adress', 50);
			$table->integer('municipality_code')->unsigned()->index();
			$table->foreign('municipality_code')->references('municipality_code')->on('municipalities');
			$table->integer('settlement_code')->unsigned()->index();
			$table->foreign('settlement_code')->references('settlement_code')->on('settlements')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('street_code')->unsigned()->index();
            $table->foreign('street_code')->references('street_code')->on('streets')->onDelete('cascade')->onUpdate('cascade');
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
		Schema::drop('partners');
	}

}
