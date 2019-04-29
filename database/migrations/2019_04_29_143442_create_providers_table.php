<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('contact_name', 50)->nullable();
            $table->string('cellphone', 25)->nullable();
            $table->string('phone_number',25)->nullable();
            // $table->timestamps();

            $table->foreign('id')->references('id')->on('clients')
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
        Schema::dropIfExists('providers');
    }
}
