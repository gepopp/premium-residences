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
        Schema::create('geo_tags', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('geotagable');
            $table->string('address');
            $table->string('address_addition')->nullable();
            $table->string('zip');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('country');
            $table->json('geotag');
            $table->integer('radius')->default(0);
            $table->integer('zoom')->default(14);
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
        Schema::dropIfExists('geo_tags');
    }
};
