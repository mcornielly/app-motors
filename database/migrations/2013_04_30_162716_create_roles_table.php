<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->boolean()->default(1);
        });

        DB::table('roles')->insert(array('id' => 1, 'name' => 'Administardor', 'description' => 'Administrador de la app'));
        DB::table('roles')->insert(array('id' => 2, 'name' => 'Usuario', 'description' => 'Usuario de la app'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
