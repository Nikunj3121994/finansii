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
			$table->string('id',36)->primary();
			$table->integer('settlement_code');
			$table->string('settlement_name', 100);
			$table->integer('ptt_code');
			$table->string('municipality_code',36)->index();
            $table->foreign('municipality_code')->references('id')->on('municipalities')->onDelete('cascade')->onUpdate('cascade');
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
