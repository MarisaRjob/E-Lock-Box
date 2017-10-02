<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('cases', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('email');
            $table->integer('cm_id')->default(0);
            $table->string('cm_name')->default('Administrator');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('ssn')->nullable();
            $table->integer('ILP')->nullable();
            $table->string('ethnicity')->nullable();
            $table->string('program')->nullable();
            $table->boolean('status')->default(1);//activated = 1, inactivated = 0
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('email');
        });

        Schema::create('docs', function (Blueprint $table)
        {
            $table->increments('id');
            $table->bigInteger('case_id')->unsigned();
            $table->string('type', 50)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('path', 255);
            $table->text('description')->nullable();
            $table->string('filename');
            $table->string('uploader', 255);
            $table->string('visible')->nullable();
            $table->timestamps();
        });

        Schema::create('additional_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('case_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('relationship')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });

        Schema::create('edu_history', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('case_id')->unsigned();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('school')->nullable();
            $table->string('level')->nullable();
            $table->string('address')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });

        Schema::create('work_history', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('case_id')->unsigned();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('company')->nullable();
            $table->string('industry')->nullable();
            $table->string('position')->nullable();
            $table->string('address')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
        Schema::create('case_phone', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('case_id')->unsigned();
            $table->string('number')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
        Schema::create('case_address', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('case_id')->unsigned();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
        Schema::create('case_email', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('case_id')->unsigned();
            $table->string('email')->nullable();
            $table->string('primary')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
        Schema::create('program_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('program_abbr')->nullable();
            $table->string('program_name')->nullable();
            $table->timestamps();
        });
        Schema::create('document_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document_abbr')->nullable();
            $table->string('document_type')->nullable();
            $table->timestamps();
        });
        Schema::create('survey', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link')->nullable();
            $table->string('description')->nullable();
            $table->string('program')->nullable();
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
        //
        Schema::drop('cases');
    }
}
