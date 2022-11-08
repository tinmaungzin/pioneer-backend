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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->char('name',50);
            $table->char('phone_number',50)->unique();
            $table->string('password');
            $table->unsignedBigInteger('allowed_table')->default(0);
            $table->foreignId('user_type_id')->constrained();
            $table->boolean('is_archived')->default(true);
            $table->unsignedBigInteger('point')->default(0);
            $table->unsignedBigInteger('balance')->default(0);
            $table->char('verify_code',50)->nullable();
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
