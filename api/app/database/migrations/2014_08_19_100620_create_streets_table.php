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
			$table->increments('id');
			$table->integer('street_code');
			$table->string('street_name', 50);
			$table->integer('settlement_code')->unsigned()->index();
            $table->foreign('settlement_code')->references('settlement_code')->on('settlements')->onDelete('cascade');
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
