<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title', 30)->comment("菜单标题");
            $table->string('slug', 30)->comment('访问菜单对应权限的slug');
            $table->string('route', 30)->comment("菜单对应的路由名称");
            $table->string('uri', 30)->comment("菜单的uri地址");
            $table->tinyInteger('status')->default(1)->comment('1-开启, 2-关闭');
            $table->string('desc')->comment('描述');
            $table->smallInteger('sort')->comment('排序');
            $table->string('icon')->comment('图标');
            $table->string('position')->default('module')->comment('权限位置,module-控制进入页面,page-控制页面中按钮,查询等');

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
        Schema::dropIfExists('menus');
    }
}
