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
			$table->string('id',36)->primary();
			$table->integer('partner_code');
			$table->string('partner_name', 50);
			$table->string('partner_address', 50);
			$table->string('municipality_code',36)->index();
			$table->foreign('municipality_code')->references('id')->on('municipalities');
			$table->string('settlement_code',36)->index();
			$table->foreign('settlement_code')->references('id')->on('settlements')->onDelete('cascade')->onUpdate('cascade');
            $table->string('street_code',36)->index();
            $table->foreign('street_code')->references('id')->on('streets')->onDelete('cascade')->onUpdate('cascade');
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
		Schema::drop('partners');
	}

}
