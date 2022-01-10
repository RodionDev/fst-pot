<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateScreensTable extends Migration
{
    public function up()
    {
        Schema::create('screens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('channel_id');
            $table->unsignedBigInteger('layout_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('active')->default(1);
            $table->string('background_color')->nullable();
            $table->string('text_color')->nullable();
            $table->string('bg_img_cdn_link')->nullable();
            $table->decimal('bg_img_opacity', 3, 2)->nullable();
            $table->string('overlay_color')->nullable();
            $table->string('heading')->nullable();
            $table->string('subheading')->nullable();
            $table->text('html_block')->nullable();
            $table->text('text_block')->nullable();
            $table->timestamps();
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('screens');
    }
}
