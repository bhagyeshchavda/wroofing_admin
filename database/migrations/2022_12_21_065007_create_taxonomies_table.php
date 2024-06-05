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
        Schema::create('taxonomies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200);
            $table->string('thumbnail', 150)->nullable();
            $table->text('description')->nullable();
            $table->string('slug', 100)->unique();
            $table->string('post_type', 50)->index();
            $table->string('taxonomy', 50)->index();
            $table->bigInteger('parent_id')->nullable()->index();
            $table->bigInteger('total_post')->default(0);
	    $table->integer('level')->default(0);
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
        Schema::dropIfExists('taxonomies');
    }
};
