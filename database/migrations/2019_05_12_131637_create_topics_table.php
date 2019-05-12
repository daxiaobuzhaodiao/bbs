<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('标题');
            $table->text('body')->comment('内容');
            $table->unsignedBigInteger('user_id')->comment('关联用户');
            $table->unsignedBigInteger('category_id')->comment('关联分类');
            $table->unsignedInteger('reply_count')->default(0)->comment('留言量');
            $table->unsignedInteger('view_count')->default(0)->comment('浏览量');
            $table->integer('last_reply_user_id')->nullable()->comment('最后留言的用户');
            $table->integer('order')->default(0)->comment('排序');
            $table->string('excerpt')->comment('文章摘要');
            $table->string('slug')->nullable()->comment('url 中显示被翻译成英文的标题');     
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
