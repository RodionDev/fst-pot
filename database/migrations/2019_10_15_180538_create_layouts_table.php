<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateLayoutsTable extends Migration
{
    public function up()
    {
        Schema::create('layouts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('layouts');
    }
}
