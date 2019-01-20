<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('unit_id')->index();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('type'); //light , ac , alarm
            $table->string('details')->nullable();
            $table->smallInteger('status')->default(1);   //1: active  // 2: inactive
            $table->integer('user_id')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            
            $table->foreign('unit_id')
                ->references('id')->on('units')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->primary('id');
        });


        DB::statement('ALTER Table components add serial INTEGER NOT NULL UNIQUE AUTO_INCREMENT  AFTER id;');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('components');
    }
}
