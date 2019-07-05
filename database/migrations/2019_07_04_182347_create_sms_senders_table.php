<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsSendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_sms_senders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',60)->nullable(false)->default("");
            $table->string('sender_id',20)->nullable(false)->default("");
            $table->string('url',100)->nullable(false)->default("");
            $table->text('api_key')->nullable(true);
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
        Schema::dropIfExists('master_sms_senders');
    }
}
