<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostLogDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slpp_post_log_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('log_header_id')->nullable(false)->default(0);
            $table->bigInteger('member_id')->nullable(false)->default(0);
            $table->integer('preferred_lang_id')->nullable(false)->default(0);
            $table->integer('used_template_id')->nullable(false)->default(0);
            $table->integer('used_lang_id')->nullable(false)->default(0);
            $table->integer('result')->nullable(false)->default(0);
            $table->string('message',40)->nullable(false)->default("");
            $table->integer('created_by')->nullable(false)->default(0);
            $table->datetime('created_at')->nullable(false)->useCurrent(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slpp_post_log_details');
    }
}
