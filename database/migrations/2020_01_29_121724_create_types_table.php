<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
        });

        Schema::create('card_specific_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->integer('card_type_id');

            $table->foreign('card_type_id')
                ->references('id')->on('card_types')
                ->onDelete('cascade');
        });

        Schema::create('types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->integer('card_type_id');

            $table->foreign('card_type_id')
                ->references('id')->on('card_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_types');
        Schema::dropIfExists('card_specific_type');
        Schema::dropIfExists('types');
    }
}
