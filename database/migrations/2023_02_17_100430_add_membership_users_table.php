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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('phone', 100)->nullable();
            $table->text('address')->nullable();
            $table->integer('country_id')->nullable();
            $table->string('state_id', 100)->nullable();
            $table->string('city_id', 100)->nullable();
            $table->string('zipcode', 100)->nullable();
            $table->integer('membership_uid')->nullable();
            $table->enum('is_suspended', ['0', '1'])->default('0')->comment('0: Not suspended | 1: suspended');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
