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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('fio');
            $table->string('phone');
            $table->integer('price_first');
            $table->integer('price_last');
            $table->date('data_last');
            $table->integer('price_two');
            $table->date('data_two');
            $table->integer('price_tree');
            $table->date('data_tree');
            $table->integer('price_four');
            $table->date('data_four');
            $table->string('debt');
            $table->date('data');
            $table->string('status');
            $table->date('data_dog');
            $table->string('groups');
            $table->string('io');
            $table->string('distant');
            $table->string('korobka');
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
    }
};
