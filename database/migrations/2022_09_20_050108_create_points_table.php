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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // pelaku
            $table->unsignedBigInteger('report_id')->nullable();
            $table->unsignedBigInteger('reporting_point')->nullable(); // pelapor
            $table->unsignedBigInteger('typevio_id')->nullable();
            $table->unsignedBigInteger('total_point')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reporting_point')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('report_id')->references('id')->on('report')->onDelete('cascade');
            $table->foreign('typevio_id')->references('id')->on('types_violations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('points');
    }
};
