<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettlementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settlements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('settlement_code');
			$table->string('settlement_name', 100);
			$table->integer('ptt_code', 4);
			$table->integer('municipality_code');
            $table->foreign('municipality_code')->references('municipality_code')->on('municipality')->onDelete('cascade');
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
		Schema::drop('settlements');
	}

}
