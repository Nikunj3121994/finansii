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
			$table->string('id',36)->primary();
			$table->string('article_name', 60);
			$table->string('tariff_code',36)->index();
			$table->foreign('tariff_code')->references('id')->on('tariffs')->onDelete('cascade')->onUpdate('cascade');
			$table->string('unit_id',36)->index();
			$table->foreign('unit_id')->references('id')->on('units');
			$table->decimal('pack', 12,3);
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
		Schema::drop('articles');
	}

}
