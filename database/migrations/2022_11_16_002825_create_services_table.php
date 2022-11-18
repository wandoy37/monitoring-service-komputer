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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('code_service');
            $table->string('status_service');
            $table->string('customer_name');
            $table->string('customer_phone', 15);
            $table->string('device');
            $table->text('keluhan');
            $table->string('store');
            $table->date('finished_at')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('technical_id')->nullable();
            $table->foreign('technical_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
};
