<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToTipPoolsTable extends Migration
{
    public function up()
    {
        Schema::table('tip_pools', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('total_amount');
        });
    }

    public function down()
    {
        Schema::table('tip_pools', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}