<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
    // $table->enum('role', [0, 1])->comment('0 = Admin, 1 : User');
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('role')->default(0)->comment('1 = Admin, 0 : User');
            $table->string('image')->default('default.svg')->nullable();
            // ketika mendaftar, harus verifikasi terlebih dahulu oleh admin
            $table->integer('is_active')->comment('0 = nonActive, 1 = Active')->nullable();
            $table->integer('menu_report_status')->default(0)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
