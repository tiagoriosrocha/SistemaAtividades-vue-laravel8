<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');           //código identificador
            $table->string('title');            //título da atividade
            $table->string('description');      //descrição da atividade
            $table->dateTime('scheduledto');    //agendado para
            $table->time('time')->default('00:00:00');
            $table->boolean('isrunning')->default(false);
            $table->timestamps();               //registro created_at e updated_at
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
};
