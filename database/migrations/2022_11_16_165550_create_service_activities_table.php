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
        Schema::create('service_activities', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['registration', 'check', 'repair', 'done', 'cancle', 'pending', 'sedang di service center'])->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

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
        Schema::dropIfExists('service_activities');
    }
};
