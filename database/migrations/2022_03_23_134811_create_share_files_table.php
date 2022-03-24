<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_files', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->unsignedInteger('share_details_id');
            $table->timestamps();
            $table->foreign('share_details_id')->references('id')->on('share_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('share_files');
    }
}
