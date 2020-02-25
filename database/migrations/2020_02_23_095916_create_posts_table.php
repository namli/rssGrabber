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
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('description');
            $table->string('link')->nullable();
            $table->string('guid')->unique();
            $table->string('author')->nullable();
            $table->timestamp('pub_time')->useCurrent();
            $table->bigInteger('feeds_id')->unsigned()->default(1);
            $table->foreign('feeds_id')->references('id')->on('feeds');
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
