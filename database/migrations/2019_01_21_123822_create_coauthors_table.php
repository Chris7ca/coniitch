<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoauthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coauthors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('work_id')->unsigned();
            $table->string('full_name');
            $table->string('email');
            $table->string('adscription');
            $table->boolean('is_first_author');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coauthors');
    }
}
