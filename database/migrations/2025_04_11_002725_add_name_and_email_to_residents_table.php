<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->string('name')->after('user_id');
            $table->string('email')->nullable()->after('name');
            $table->dropColumn('emergency_contact');
        });
    }

    public function down()
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropColumn(['name', 'email']);
            $table->string('emergency_contact')->nullable();
        });
    }
};
