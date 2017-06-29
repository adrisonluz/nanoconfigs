<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNanoNvaccess extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('nano_nvaccess', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 45);
            $table->unsignedInteger('nivel')->nullable();
            $table->foreign('nivel')
                    ->references('id')->on('nano_niveis')
                    ->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('nano_nvaccess');
    }

}
