<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkUcpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_ucp', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->boolean('activo');
            $table->string('titulo', 300);
            $table->string('descripcion', 300);

            $table->string('linkucp', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_ucp');
    }
}
