<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_relations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('menu_id')->unsigned()->index();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');

            $table->integer('menu_parent_id')->unsigned()->index();
            $table->foreign('menu_parent_id')->references('id')->on('menus')->onDelete('cascade');

            $table->tinyInteger('sort')->unsigned()->comment("排序");
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
        Schema::dropIfExists('menu_relations');
    }
}
