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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable');
            $table->string('search_string')->nullable();
            $table->string('line_1');
            $table->string('line_2')->nullable();
            $table->string('zip');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->text('formatted_address')->nullable();
            $table->float('lat', 10,8);
            $table->float('long', 11,8);
            $table->integer('zoom')->default(14);
            $table->boolean('show_pin')->default(true);
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
        Schema::dropIfExists('addresses');
    }
};
