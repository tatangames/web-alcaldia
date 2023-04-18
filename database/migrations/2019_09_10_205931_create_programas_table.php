<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programas', function (Blueprint $table) {
            $table->bigIncrements('idprograma');
            $table->string('nombreprograma', 450);
            $table->boolean('estado')->default('0');           
            $table->string('logo', 100);
            $table->text('descorta');
            $table->text('deslarga');    
            $table->string('imagen', 250)->nullable();
            $table->string('slug', 150)->unique();        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programas');
    }
}
