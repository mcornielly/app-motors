<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            $table->text('address', 200);
            $table->string('locality');
            $table->string('province');
            $table->string('phone_number');
            $table->string('nextel_number')->nullable();
            $table->string('cell_number')->nullable();
            $table->softDeletes();
            $table->timestamps();

            //Relation
            $table->foreign('client_id')->references('id')->on('clients')
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
        Schema::dropIfExists('addresses');
    }
}
