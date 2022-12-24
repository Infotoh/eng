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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->integer('number2')->nullable();
            $table->string('name');
            $table->integer('age')->nullable();
            $table->string('gender_type')->nullable();
            $table->string('qualification');

            $table->foreignIdFor(\App\Models\Categorey::class);
            $table->foreignIdFor(\App\Models\User::class);
            
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
        Schema::dropIfExists('trainings');
    }
};
