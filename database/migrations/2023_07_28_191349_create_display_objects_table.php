<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('display_objects', function (Blueprint $table) {
            $table->id();
            $table->string('type');
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
     */
    public function down(): void
    {
        Schema::dropIfExists('display_objects');
    }
};
