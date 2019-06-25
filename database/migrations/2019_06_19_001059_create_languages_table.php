<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('language',40)->nullable(false)->default("");
            $table->string('code',40)->nullable(false)->default("");
            $table->string('caption',40)->nullable(false)->default("")->charset('utf8')->collation('utf8_unicode_ci');
            $table->integer('status')->nullable(false)->default(1);
            $table->integer('created_by')->nullable(false)->default(0);
            $table->datetime('created_at')->nullable(false)->useCurrent();
            $table->datetime('updated_at')->nullable(false)->useCurrent();
        });

        DB::table('master_languages')->insert([
            [
                'id' => 1,
                'language' => 'English',
                'code' => 'en',
                'caption' => 'English',
                'status' => 1
            ],
            [
                'id' => 2,
                'language' => 'Sinhala',
                'code' => 'si',
                'caption' => 'සිංහල',
                'status' => 1
            ],
            [
                'id' => 3,
                'language' => 'Tamil',
                'code' => 'ta',
                'caption' => 'தமிழ்',
                'status' => 1
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_languages');
    }
}
