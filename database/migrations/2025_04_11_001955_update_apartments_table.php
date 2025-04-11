<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->integer('number_of_rooms')->default(1)->change();
        });
    }
    public function down(): void
    {
        //
    }
};
