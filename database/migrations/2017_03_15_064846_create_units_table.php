<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {

            $table->string('id')->unique();
            $table->integer('building_id')->unsigned();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('version')->default('1.0');
            $table->string('details')->nullable();
            $table->smallInteger('status')->default(1);   //1: active  // 2: inactive
            $table->integer('user_id')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            
            $table->foreign('building_id')
                ->references('id')->on('buildings')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->primary('id');

        });


        DB::statement('ALTER Table units add serial INTEGER NOT NULL UNIQUE AUTO_INCREMENT  AFTER id;');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
