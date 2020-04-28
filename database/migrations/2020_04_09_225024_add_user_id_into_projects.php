<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdIntoProjects extends Migration
{
    /**
     * 运行migrate时候执行
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->integer('user_id');
            //$table->addColumn();写法二
        });
    }

    /**
     * migrate:rollback时候执行的操作，回滚上一次的migrate
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
