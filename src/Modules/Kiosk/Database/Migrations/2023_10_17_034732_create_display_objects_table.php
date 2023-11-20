<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('display_objects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('plugin_slug');
            $table->integer('pos_x');
            $table->integer('pos_y');
            $table->integer('width');
            $table->integer('height');
            $table->integer('display_object_parent_id')->nullable();
            $table->integer('display_id');
            $table->integer('zindex');
            $table->text('data');
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
        Schema::dropIfExists('display_objects');
    }
};
