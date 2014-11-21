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
			$table->string('id',36)->primary();
            $table->integer('account');
			$table->string('account_name', 50);
			$table->integer('account_type');
			$table->string('sub_account_code',36)->index()->nullable();
            $table->foreign('sub_account_code')->references('id')->on('sub_accounts');
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
