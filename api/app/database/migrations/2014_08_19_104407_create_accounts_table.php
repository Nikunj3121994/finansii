<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accounts', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('account')->unsigned()->index();
			$table->string('account_name', 50);
			$table->integer('account_type');
			$table->integer('sub_account_code')->unsigned()->index()->nullable();
            $table->foreign('sub_account_code')->references('sub_account_code')->on('sub_accounts');
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
		Schema::drop('accounts');
	}

}
