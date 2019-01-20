<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateButtonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buttons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('switch_id')->index();
            $table->string('component_id')->nullable()->index();
            $table->string('type')->nullable();
            $table->string('title');
            $table->integer('register')->unsigned();
            $table->string('details')->nullable();
            $table->smallInteger('status')->default(1);   //1: active  // 2: inactive
            $table->integer('user_id')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('switch_id')
                ->references('id')->on('switches')
                ->onDelete('cascade');



            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buttons');
    }
}
