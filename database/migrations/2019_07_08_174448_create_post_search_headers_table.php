<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostSearchHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slpp_post_search_headers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mode',10)->nullable(false)->default('multiple');
            $table->integer('province_id')->nullable(false)->default(1);
            $table->integer('district_id')->nullable(false)->default(1);
            $table->integer('electorate_id')->nullable(false)->default(1);
            $table->integer('local_auth_id')->nullable(false)->default(1);
            $table->integer('ward_id')->nullable(false)->default(1);
            $table->integer('gn_id')->nullable(false)->default(1);
            $table->json('categories')->nullable(true);
            $table->integer('created_by')->nullable(false)->default(0);
            $table->dateTime('created_at')->nullable(false)->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slpp_post_search_headers');
    }
}
