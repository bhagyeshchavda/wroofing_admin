<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'media_files',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('type', 50)->default('image');
                $table->string('mime_type');
                $table->string('path');
                $table->string('extension');
                $table->bigInteger('size')->default(0);
                $table->bigInteger('folder_id')->index()->nullable();
                $table->string('user_id')->index();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_files');
    }
};
