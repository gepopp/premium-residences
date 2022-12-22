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

        Schema::create('articles', function (Blueprint $table) {

            $table->id();
            $table->string('slug');
            $table->foreignIdFor(\App\Models\User::class);
            $table->json('title');
            $table->json('content');
            $table->softDeletes();
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

        Schema::dropIfExists('articles');
    }
};
