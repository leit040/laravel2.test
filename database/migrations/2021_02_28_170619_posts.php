<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->text('body');
            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id');
            $table->foreignId('tag_id');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('posts');
    }
}
