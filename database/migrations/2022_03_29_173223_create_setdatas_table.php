<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setdatas', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->integer('temp');
            $table->integer('pc');
            $table->integer('hc');
            $table->integer('jan');
            $table->integer('feb');
            $table->integer('mar');
            $table->integer('apr');
            $table->integer('may');
            $table->integer('jun');
            $table->integer('jul');
            $table->integer('aug');
            $table->integer('sep');
            $table->integer('oct');
            $table->integer('nov');
            $table->integer('dec');
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
        Schema::dropIfExists('setdatas');
    }
}
