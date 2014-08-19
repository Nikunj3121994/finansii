<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sub_accounts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('sub_account_code', 3);
			$table->string('sub_account_name', 50);
			$table->string('sub_account_table',20);
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
		Schema::drop('sub_accounts');
	}

}
