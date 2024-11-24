<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
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
            $table->string('image');

            $table->longText('content');
            $table->text('description');
            $table->string('tags')->nullable();
            $table->text('title');
            $table->text('slug');
            $table->integer('shares')->default(0);
            $table->integer('views')->default(0);
            $table->string('reporter_name')->nullable();
            $table->string('ct_user')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
