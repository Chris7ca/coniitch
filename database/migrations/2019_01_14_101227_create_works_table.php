<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title')->nullable();
            $table->enum('theme', ['Health and Society', 'Transdiscipline'])->nullable();
            $table->enum('type', ['Oral','Banner'])->nullable();
            $table->enum('axis', ['Research','Theoretical'])->nullable();
            $table->string('adscription')->nullable();
            $table->text('content')->nullable();
            $table->boolean('ready')->nullable();
            $table->smallInteger('version')->default(0);
            $table->smallInteger('evaluation')->nullable();
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
        Schema::dropIfExists('works');
    }
}
