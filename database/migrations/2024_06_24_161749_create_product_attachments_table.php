<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uploaded_user_id');
            $table->string('url');
            $table->string('state')->nullable();
            $table->string('label')->nullable();
            $table->string('file')->nullable();
            $table->string('content_type')->nullable();
            $table->string('user')->nullable();
            $table->unsignedBigInteger('attachmentable_id');
            $table->string('attachmentable_type'); 
            $table->softDeletes();
            $table->timestamps();
        
            $table->foreign('uploaded_user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attachments');
    }
}
