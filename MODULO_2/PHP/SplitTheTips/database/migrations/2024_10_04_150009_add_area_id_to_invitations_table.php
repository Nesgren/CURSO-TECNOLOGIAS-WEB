<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->unsignedBigInteger('area_id')->nullable()->after('company_id');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropForeign(['area_id']);
            $table->dropColumn('area_id');
        });
    }
};