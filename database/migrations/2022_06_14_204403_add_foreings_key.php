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
        Schema::table('posts', function($table){
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('frame_id');
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('frame_id')->references('id')->on('frames');
        });

        Schema::table('messages', function($table){
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('post_id'); 
                        
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('post_id')->references('id')->on('posts');
        });

        Schema::table('frames', function($table){
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
        });

        ///////////////////////////////
        // New method to foreign key
        ///////////////////////////////

        // Schema::table('posts', function($table){
        //     $table->foreignId('user_id')->constrained('users'); 
        //     $table->foreignId('frame_id')->constrained('frames');
        // });

        // Schema::table('messages', function($table){
        //     $table->foreignId('user_id')->constrained('users'); 
        //     $table->foreignId('post_id')->constrained('posts'); 
        // });

        // Schema::table('frames', function($table){
        //     $table->foreignId('user_id')->constrained('users');
        // });


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
