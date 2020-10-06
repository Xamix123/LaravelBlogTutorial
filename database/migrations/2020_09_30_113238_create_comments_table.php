<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->BigInteger('post_id')->unsigned()->index();
            $table->foreign('post_id')
                ->references('id')->on('posts');
            $table->text('text_comment');
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
        Schema::dropIfExists('comments');
    }
}
