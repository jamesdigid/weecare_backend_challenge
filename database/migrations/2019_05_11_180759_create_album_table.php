<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('itunes_id')->index();
            $table->longText('name');
            $table->longText('title');
            $table->longText('artist_label');
            $table->longText('artist_href')->nullable(); // Not always present if artist is Various Artist
            $table->integer('item_count');
            $table->string('price');
            $table->longText('rights');
            $table->longText('link');
            $table->integer('category_id')->unsigned();
            $table->integer('content_type_id')->unsigned();
            $table->timestampTz('release_date'); // 2019-05-10T00:00:00-07:00
            $table->timestamps();

            $table->foreign('content_type_id')
            ->references('id')
            ->on('content_type')
            ->onDelete('cascade');

            $table->foreign('category_id')
            ->references('id')
            ->on('category')
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
        Schema::dropIfExists('album');
    }
}
