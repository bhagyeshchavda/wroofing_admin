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
        //
        Schema::create(
            'posts',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title', 250);
                $table->string('thumbnail', 250)->nullable();
                $table->string('slug', 150)->unique();
                $table->string('description', 200)->nullable();
                $table->longText('content')->nullable();
                $table->string('status', 50)->index()->default('draft');
                $table->bigInteger('views')->default(0);
				$table->string('type', 50)->index()->default('posts');
				$table->json('json_metas')->nullable();
                $table->json('templateStatus')->nullable();
				$table->json('json_taxonomies')->nullable();
				$table->float('rating')->default(0);
				$table->integer('total_rating')->default(0);
				$table->bigInteger('total_comment')->default(0);
                $table->timestamps();
            }
        );

        Schema::create(
            'post_metas',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('post_id')->index();
                $table->string('meta_key', 150)->index();
                $table->text('meta_value')->nullable();
                $table->unique(['post_id', 'meta_key']);

                $table->foreign('post_id')
                    ->references('id')
                    ->on('posts')
                    ->onDelete('cascade');
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
        //
        Schema::dropIfExists('post_metas');
        Schema::dropIfExists('posts');
    }
};
