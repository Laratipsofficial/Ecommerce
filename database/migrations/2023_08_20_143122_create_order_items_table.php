<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('table_round')->nullable();
            $table->integer('order_id');
            $table->integer('menu_item_id');
            $table->decimal('price');
            $table->decimal('discount')->default(0);
            $table->integer('quantity');
            $table->integer('menu_side_item_id')->nullable();
            $table->string('comment')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
