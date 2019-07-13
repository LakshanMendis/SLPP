<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MemberAddOverseasAddressFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slpp_members', function (Blueprint $table) {
            $table->string('overseas_address_line1',80)->nullable(true)->after('postal_code');
            $table->string('overseas_address_line2',80)->nullable(true)->after('overseas_address_line1');
            $table->string('overseas_city',40)->nullable(true)->after('overseas_address_line2');
            $table->string('overseas_postal_code',20)->nullable(true)->after('overseas_city');
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
