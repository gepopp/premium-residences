<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



return new class extends Migration {





    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create( 'images', function ( Blueprint $table ) {

            $table->id();
            $table->nullableMorphs( 'imageable' );
            $table->string('field')->nullable();
            $table->string('alt');
            $table->string('description')->nullable();
            $table->string('path');
            $table->string('url')->nullable();
            $table->integer('width');
            $table->integer('height');
            $table->integer('size');
            $table->timestamps();
        } );
    }





    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists( 'images' );
    }
};
