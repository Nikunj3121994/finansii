<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCalculationHeadersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('calculation_headers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('business_unit_id')->unsigned()->index();
			$table->foreign('business_unit_id')->references('id')->on('business_units')->onDelete('cascade')->onUpdate('cascade');
			$table->integer('calculation_number');
			$table->integer('document_number');
			$table->integer('partner_code')->unsigned()->index();
			$table->foreign('partner_code')->references('partner_code')->on('partners')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('calculation_date');
			$table->timestamp('calculation_ddo');
			$table->timestamp('calculation_booked');
			$table->integer('currency_code')->unsigned()->index();
			$table->foreign('currency_code')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
			$table->decimal('currency_value', 12,6);
			$table->integer('calculation_type_code')->unsigned()->index();
			$table->foreign('calculation_type_code')->references('calculation_type_code')->on('calculation_types')->onDelete('cascade')->onUpdate('cascade');
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
		Schema::drop('calculation_headers');
	}

}
