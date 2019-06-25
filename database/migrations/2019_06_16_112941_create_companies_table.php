<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name',100)->nullable(false)->default("");
            $table->string('short_name',60)->nullable(false)->default("");
            $table->string('slogan',150)->nullable(false)->default("");
            $table->binary('logo_large')->nullable(true);
            $table->binary('logo_medium')->nullable(true);
            $table->binary('logo_small')->nullable(true);
            $table->string('address_line1',60)->nullable(false)->default("");
            $table->string('address_line2',60)->nullable(true);
            $table->string('address_line3',60)->nullable(true);
            $table->string('city',40)->nullable(false)->default("");
            $table->string('country',40)->nullable(false)->default("");
            $table->string('hotline',20)->nullable(false)->default("");
            $table->string('tel1',20)->nullable(false)->default("");
            $table->string('tel2',20)->nullable(true);
            $table->string('tel3',20)->nullable(true);
            $table->string('fax1',20)->nullable(false)->default("");
            $table->string('fax2',20)->nullable(true);
            $table->string('fax3',20)->nullable(true);
            $table->string('email',60)->nullable(false)->default("");
            $table->string('corporate_code',60)->nullable(false)->default("");
            $table->string('business_reg',60)->nullable(false)->default("");
            $table->string('vat_reg',60)->nullable(false)->default("");
            $table->string('svat_reg',60)->nullable(false)->default("");
            $table->integer('status')->nullable(false)->default(1);
            $table->integer('created_by')->nullable(true);
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
        Schema::dropIfExists('master_companies');
    }
}
