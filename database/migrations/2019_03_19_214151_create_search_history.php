<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchHistory extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('search_history')) {
            Schema::create('search_history', function (Blueprint $table) {

                $table->increments('id')->comment('自增id');
                $table->integer('uid')->unsign()->index()->default(0)->comment('用户id');
                $table->string('keyword', 100)->default('')->comment('搜索内容');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('search_history');
    }
}
