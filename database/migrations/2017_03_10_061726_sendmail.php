<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sendmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('to',150);
            $table->string('parameters',250);
            $table->string('template',150);
            $table->string('names',150);
            $table->string('subject',150);
            $table->string('files',150)->nullable();
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
        Schema::dropIfExists('mail_users');
    }
}
