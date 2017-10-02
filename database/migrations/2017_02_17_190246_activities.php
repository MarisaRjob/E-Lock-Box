<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Activities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('activities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->text('subject')->nullable();
            $table->text('message')->nullable();
            $table->boolean('task')->default(0);//not finished 0; finished 1
            $table->datetime('ddl')->nullable();
            $table->integer('assigned')->nullable();
            $table->integer('creator')->nullable();
            $table->integer('mentioned')->nullable();
            $table->string('related')->nullable();
            $table->boolean('reci_status')->default(0);//0 not read, 1 read
            $table->boolean('ment_status')->default(0);//0 not read, 1 read
            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
