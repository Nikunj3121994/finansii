<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFieldFormConfigTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('field_form_config', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('field_id')->unsigned()->index();
			$table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
			$table->integer('form_config_id')->unsigned()->index();
			$table->foreign('form_config_id')->references('id')->on('form_configs')->onDelete('cascade');
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
		Schema::drop('field_form_config');
	}

}
