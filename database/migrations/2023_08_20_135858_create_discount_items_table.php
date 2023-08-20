<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('discount_items', function (Blueprint $table) {
            $table->id();
            $table->string('discount');
            $table->foreignId('discount_id')->constrained('discounts');
            $table->foreignId('menu_item_id')->constrained('menu_items');
            $table->softDeletes();
            $table->timestamps();
        });


    }

    public function down()
    {
        Schema::dropIfExists('discount_items');
    }
};
