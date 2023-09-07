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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->char('name',50)->nullable();
            $table->char('phone_number',50)->nullable();
            $table->foreignId('event_table_id')->nullable()->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->char('photo', 100)->nullable();
            $table->boolean('use_balance')->default(0);
            $table->string('note')->nullable();
            $table->string('admin_note')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
