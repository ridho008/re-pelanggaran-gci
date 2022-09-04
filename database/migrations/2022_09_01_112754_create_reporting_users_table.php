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
        Schema::create('reporting_details', function (Blueprint $table) {
            // user pelapor
            $table->id();
            $table->tinyInteger('user_id')->nullable(); // pelapor
            $table->tinyInteger('reporting_id')->nullable(); // pelaku 
            $table->tinyInteger('point')->default(0)->nullable();
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
        Schema::dropIfExists('reporting_users');
    }
};
