<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketReplyFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_reply_files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ticket_reply_id');
            $table->string('file_name');
            $table->timestamps();
            $table->foreign('ticket_reply_id')->references('id')->on('ticket_replies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_reply_files');
    }
}
