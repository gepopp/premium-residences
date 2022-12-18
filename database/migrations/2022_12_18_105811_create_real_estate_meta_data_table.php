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
    public function up()
    {

        Schema::create('real_estate_meta_data', function (Blueprint $table) {

            $table->id();
            $table->foreignIdFor(\App\Models\RealEstate::class);
            $table->unsignedInteger('order')->default(100);
            $table->string('number')->nullable();
            $table->json('text');
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

        Schema::dropIfExists('real_estate_meta_data');
    }
};
