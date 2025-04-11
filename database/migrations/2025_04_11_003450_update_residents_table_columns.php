<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('residents', function (Blueprint $table) {
            if (!Schema::hasColumn('residents', 'name')) {
                $table->string('name')->after('user_id');
            }

            if (!Schema::hasColumn('residents', 'email')) {
                $table->string('email')->nullable()->after('phone');
            }
            if (Schema::hasColumn('residents', 'apartment_id')) {
                $table->foreignId('apartment_id')->change();
            } else {
                $table->foreignId('apartment_id')->constrained();
            }

            if (Schema::hasColumn('residents', 'phone')) {
                $table->string('phone')->nullable()->change();
            }
        });
    }

    public function down()
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->string('phone')->nullable(false)->change();
        });
    }
};
