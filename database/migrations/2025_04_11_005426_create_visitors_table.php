<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->text('reason');
            $table->foreignId('resident_id')->constrained()->onDelete('cascade');
            $table->dateTime('entry_time');
            $table->dateTime('expected_exit_time');
            $table->string('visit_type')->default('guest');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->dateTime('actual_exit_time')->nullable();
            $table->timestamps();

            $table->index('entry_time');
            $table->index('expected_exit_time');
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitors');
    }
};
