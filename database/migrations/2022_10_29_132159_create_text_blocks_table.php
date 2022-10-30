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
        Schema::create('text_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->nullableMorphs('textable');
            $table->string('field')->nullable();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('contents');
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
        Schema::dropIfExists('text_blocks');
    }
};
