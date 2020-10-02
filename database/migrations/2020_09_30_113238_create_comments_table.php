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
            $table->BigInteger('id_user')->unsigned()->index();
            $table->foreign('id_user')
                ->references('id')->on('users');
            $table->BigInteger('id_post')->unsigned()->index();
            $table->foreign('id_post')
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
