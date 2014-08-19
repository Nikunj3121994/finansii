<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLadgersTable extends Migration {

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
            $table->foreign('company_code')->references('company_code')->on('companies')->onDelete('cascade');
			$table->integer('order_id')->unsigned()->index();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
			$table->string('account', 10);
			$table->integer('sub_account')->unsigned()->index();
            $table->foreign('sub_account')->references('id')->on('accounts')->onDelete('cascade');
			$table->timestamp('date');
			$table->string('document_number', 20);
			$table->string('document_desc', 30);
			$table->timestamp('document_date');
			$table->integer('booking_type', 1);
			$table->decimal('amount', 18,6);
			$table->integer('currency_code')->unsigned()->index();
            $table->foreign('currency_code')->references('id')->on('currencies')->onDelete('cascade');
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
		Schema::drop('ladgers');
	}

}
