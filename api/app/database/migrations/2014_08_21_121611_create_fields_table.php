<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFieldsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name',50);
            $table->string('label',50);
            $table->boolean('visible');
            $table->string('type',20);
            $table->integer('edit');
            $table->boolean('required');
            $table->integer('form_config_id')->index();
            $table->foreign('form_config_id')->references('id')->on('form_configs')->onDelete('cascade');
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
        Schema::drop('fields');
    }

}
