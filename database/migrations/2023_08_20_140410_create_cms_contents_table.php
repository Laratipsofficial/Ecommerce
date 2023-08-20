<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cms_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('seoTitle');
            $table->string('seoDescription');
            $table->string('displayName');
            $table->string('slug');
            $table->longText('content');
            $table->string('culture')->default('nl');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cms_contents');
    }
};
