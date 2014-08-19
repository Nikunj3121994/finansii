<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBankCompanyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bank_company', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('bank_id')->unsigned()->index();
			$table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
			$table->integer('company_id')->unsigned()->index();
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->string('bank_account',15);
            $table->integer('rang');
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
		Schema::drop('bank_company');
	}

}
