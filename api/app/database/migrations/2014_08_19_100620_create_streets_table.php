<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStreetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('streets', function(Blueprint $table)
		{
			$table->string('id',36)->primary();
			$table->integer('street_code');
			$table->string('street_name', 50);
			$table->string('settlement_code',36)->index();
            $table->foreign('settlement_code')->references('id')->on('settlements')->onDelete('cascade')->onUpdate('cascade');
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
		Schema::drop('streets');
	}

}
