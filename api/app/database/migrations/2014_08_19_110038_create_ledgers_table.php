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
			$table->increments('id');
			$table->integer('company_code')->unsigned()->index();
            $table->foreign('company_code')->references('company_code')->on('companies')->onDelete('cascade')->onUpdate('cascade');
			$table->integer('order_id')->unsigned()->index();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
			$table->string('sub_account', 10);
			$table->integer('account')->unsigned()->index();
            $table->foreign('account')->references('account')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
			$table->string('document_number', 20);
			$table->string('document_desc', 30);
			$table->timestamp('document_date');
			$table->integer('booking_type');
			$table->decimal('amount', 18,6);
			$table->integer('currency_code')->unsigned()->index();
            $table->foreign('currency_code')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
			$table->decimal('amount_currency', 18,6);
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
