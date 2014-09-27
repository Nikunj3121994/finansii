<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('article_name', 60);
			$table->integer('tariff_code')->unsigned()->index();
			$table->foreign('tariff_code')->references('tariff_code')->on('tariffs')->onDelete('cascade')->onUpdate('cascade');
			$table->integer('unit_id')->unsigned()->index();
			$table->foreign('unit_id')->references('id')->on('units');
			$table->decimal('pack', 12,3);
            $table->integer('user')->unsigned()->index();
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
		Schema::drop('articles');
	}

}
