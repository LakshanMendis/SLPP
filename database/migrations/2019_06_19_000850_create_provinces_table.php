<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_provinces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',40)->nullable(false)->default("");
            $table->string('name_en',40)->nullable(false)->default("");
            $table->string('name_si',40)->nullable(false)->default("")->charset('utf8')->collation('utf8_unicode_ci');
            $table->string('name_ta',40)->nullable(false)->default("")->charset('utf8')->collation('utf8_unicode_ci');
            $table->integer('status')->nullable(false)->default(1);
            $table->integer('created_by')->nullable(false)->default(0);
            $table->datetime('created_at')->nullable(false)->useCurrent();
            $table->datetime('updated_at')->nullable(false)->useCurrent();
        });

        DB::table('master_provinces')->insert([
            'id' => 1,
            'name' => 'Undefined',
            'name_en' => 'Undefined',
            'name_si' => 'ප්‍රකාශ නොකළ',
            'name_ta' => 'அறிவிக்கப்படாத',
            'status' => 0
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_provinces');
    }
}
