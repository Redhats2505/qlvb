<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description');
            $table->string('document')->nullable();
            $table->date('date_expried')->nullable();
            $table->integer('notif_date')->nullable();
            $table->string('email_notif')->nullable();
            $table->integer('status')->nullable();
            $table->integer('id_parent')->nullable();
            $table->uuid('Create_uid')->nullable();
            $table->uuid('Edit_uid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
