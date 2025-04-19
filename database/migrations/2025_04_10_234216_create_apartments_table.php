<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('building_name', 100);
            $table->string('apartment_number', 50);
            $table->integer('floor');
            $table->integer('number_of_rooms')->default(1);
            $table->string('status')->default('vacant');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['building_name', 'apartment_number']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('apartments');
    }
};
