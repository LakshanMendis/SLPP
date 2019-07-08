<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostLogHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slpp_post_log_headers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('search_header_id')->nullable(false)->default(0);
            $table->integer('template_id')->nullable(false)->default(0);
            $table->string('media',20)->nullable(true);
            $table->integer('language_id')->nullable(false)->default(0);
            $table->integer('member_count')->nullable(false)->default(0);
            $table->integer('created_by')->nullable(false)->default(0);
            $table->datetime('created_at')->nullable(false)->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slpp_post_log_headers');
    }
}
