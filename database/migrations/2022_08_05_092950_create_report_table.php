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
        Schema::create('report', function (Blueprint $table) {
            $table->id();
            // pelaku
            // $table->unsignedBigInteger('user_id')->nullable();
            // pelapor
            $table->unsignedBigInteger('reporting_id_detail')->nullable();
            $table->text('description')->nullable();
            // bukti foto
            $table->string('proof_fhoto')->nullable();
            $table->text('reply_comment')->nullable();
            // tanggal melihat pelanggaran
            $table->date('reporting_date')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('reporting')->references('id')->on('users')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report');
    }
};
