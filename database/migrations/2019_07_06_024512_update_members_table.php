<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slpp_members', function (Blueprint $table) {
            $table->integer('living_abroad')->nullable(false)->default(0)->after('city');
            $table->integer('country_id')->nullable(false)->default(202)->after('living_abroad');
            $table->string('dialing_code',10)->nullable(false)->default("+94")->after('country_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
