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
        Schema::create('set_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('set_id')->nullable()->constrained();
            $table->foreignId('type_id')->nullable()->constrained();
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('table_count')->default(0);
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
        Schema::dropIfExists('set_type');
    }
};
