<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOperatorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('operators', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('operator_name', 30);
			$table->string('operator_rang', 10);
			$table->string('operator_pass', 10);
			$table->string('operator_telephone', 15);
			$table->string('operator_mail', 50);
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
		Schema::drop('operators');
	}

}
