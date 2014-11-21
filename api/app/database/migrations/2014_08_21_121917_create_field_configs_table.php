<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFieldConfigsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_configs', function(Blueprint $table)
        {
            $table->string('id',36)->primary();
            $table->string('field_id',36)->index();
            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
            $table->string('key');
            $table->string('value');
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
        Schema::drop('field_configs');
    }

}
