<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id')->nullable(true);
            $table->string('location',60)->nullable(false)->default("");
            $table->string('address_line1',60)->nullable(false)->default("");
            $table->string('address_line2',60)->nullable(true);
            $table->string('address_line3',60)->nullable(true);
            $table->string('city',60)->nullable(false)->default("");
            $table->string('hotline',20)->nullable(false)->default("");
            $table->string('tel1',20)->nullable(false)->default("");
            $table->string('tel2',20)->nullable(true);
            $table->string('fax1',20)->nullable(false)->default("");
            $table->string('fax2',20)->nullable(true);
            $table->string('email',40)->nullable(false)->default("");
            $table->double('latitude')->nullable(false)->default(0);
            $table->double('longitude')->nullable(false)->default(0);
            $table->integer('module_specific')->nullable(false)->default(0);
            $table->integer('module_id')->nullable(true);
            $table->integer('status')->nullable(false)->default(1);
            $table->integer('created_by')->nullable(false)->default(0);
            $table->datetime('created_at')->nullable(false)->useCurrent();
            $table->datetime('updated_at')->nullable(false)->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_locations');
    }
}
