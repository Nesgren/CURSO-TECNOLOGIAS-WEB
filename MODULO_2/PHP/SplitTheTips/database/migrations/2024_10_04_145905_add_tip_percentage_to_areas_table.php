<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->decimal('tip_percentage', 5, 2)->nullable()->after('name');
        });
    }

    public function down()
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->dropColumn('tip_percentage');
        });
    }
};