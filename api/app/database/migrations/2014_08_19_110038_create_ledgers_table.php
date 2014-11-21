<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLedgersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ledgers', function(Blueprint $table)
		{
			$table->string('id',36)->primary();
			$table->string('company_code',36)->index();
            $table->foreign('company_code')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
			$table->string('order_id',36)->index();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
			$table->string('sub_account', 10);
			$table->string('account',36)->index();
            $table->foreign('account')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
			$table->string('document_number', 20);
			$table->string('document_desc', 30);
			$table->timestamp('document_date');
			$table->integer('booking_type');
			$table->decimal('amount', 18,6);
			$table->string('currency_code',36)->index();
            $table->foreign('currency_code')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
			$table->decimal('amount_currency', 18,6);
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
		Schema::drop('ledgers');
	}

}
