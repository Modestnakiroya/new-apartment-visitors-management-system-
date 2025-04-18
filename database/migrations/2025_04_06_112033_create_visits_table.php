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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
        $table->foreignId('visitor_id')->constrained();
        $table->foreignId('resident_id')->constrained();
        $table->string('purpose');
        $table->string('check_in_time');
        $table->text('purpose_details')->nullable();
        $table->date('visit_date');
        $table->time('expected_arrival_time');
        $table->time('actual_arrival_time')->nullable();
        $table->time('departure_time')->nullable();
        $table->boolean('is_pre_registered')->default(false);
        $table->enum('status', ['pending', 'checked-in', 'completed', 'cancelled'])->default('pending');
        $table->string('pass_id')->unique();
        $table->text('notes')->nullable();
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
        Schema::dropIfExists('visits');
    }
};
