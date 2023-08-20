<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('table_id');
            $table->string('order_id');
            $table->string('comment')->nullable();
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->softDeletes();
            $table->timestamps();
        });

        // add foreign key to tables for current reservation
        Schema::table('tables', function (Blueprint $table) {
            $table->foreignId('current_reservation_id')->nullable()->constrained('reservations');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
