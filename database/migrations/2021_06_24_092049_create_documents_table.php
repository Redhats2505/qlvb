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
            $table->string('descriptions');
            $table->string('document')->nullable();
            $table->date('regis_date')->nullable();
            $table->string('regis_form_no')->nullable();
            $table->date('effective_date')->nullable();
            $table->string('effective_no')->nullable();
            $table->date('expried_date')->nullable();
            $table->integer('notif_date')->nullable();
            $table->string('notif_email')->nullable();
            $table->string('document_group')->nullable();
            $table->integer('document_group2')->nullable();
            $table->integer('document_owner')->nullable();
            $table->integer('document_types')->nullable();
            $table->integer('document_country')->nullable();
            $table->integer('status')->nullable();
            $table->integer('id_parent')->nullable();
            $table->string('note')->nullable();
            $table->uuid('Create_uid')->nullable();
            $table->uuid('Edit_uid')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
