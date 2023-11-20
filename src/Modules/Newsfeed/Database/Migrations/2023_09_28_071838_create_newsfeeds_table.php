<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsfeeds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('areas')->insert([[
                'name' => 'Newsfeed',
                'slug' => 'newsfeed',
                'parent_slug' => null, 
            ],
            [
                'name' => 'Newsfeed erstellen',
                'slug' => 'newsfeed.create',
                'parent_slug' => 'newsfeed',
            ],
            [
                'name' => 'Artikel erstellen',
                'slug' => 'newsfeed.article.create',
                'parent_slug' => 'newsfeed',
            ],
            [
                'name' => 'Artikel veröffentlichen',
                'slug' => 'newsfeed.article.publish',
                'parent_slug' => 'newsfeed',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('newsfeeds');
    }
};
