<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slpp_member_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_id')->nullable(false)->default(0);
            $table->string('tag',40)->nullable(false)->default("")->charset('utf8')->collation('utf8_unicode_ci');
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
        Schema::dropIfExists('slpp_member_tags');
    }
}
