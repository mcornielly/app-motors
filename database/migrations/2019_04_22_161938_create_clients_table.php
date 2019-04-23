<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('code');
            $table->string('name', 60);
            $table->string('razon_social', 80);
            $table->string('nickname');
            $table->string('email')->nullable();
            $table->date('birth_date');
            $table->string('reference');
            $table->string('cp');
            $table->string('cuit');
            $table->double('tax',2);
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
        Schema::dropIfExists('clients');
    }
}
