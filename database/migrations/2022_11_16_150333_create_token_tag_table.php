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
        Schema::create('token_tag', function (Blueprint $table) {
            $table->integer('id')->unsigned()->unique()->autoIncrement();
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('token_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('token_tag');
    }
};
