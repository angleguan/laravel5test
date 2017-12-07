<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');//用户发布的id
            $table->integer('live_category_id');//live的分类 关联
            $table->char('title');
            $table->text('content');
            $table->integer('status');
            $table->timestamp('start_time');//live开始时间
            $table->timestamp('end_time');//live结束时间
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
        Schema::drop('live');
    }
}
