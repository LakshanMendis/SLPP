<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailSendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_mail_senders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('caption',40)->nullable(false)->default("");
            $table->string('name',60)->nullable(false)->default("");
            $table->string('email',60)->nullable(false)->default("");
            $table->string('host',60)->nullable(false)->default("");
            $table->string('security_chanel',10)->nullable(false)->default("ssl");
            $table->integer('port')->nullable(false)->default(465);
            $table->string('username',60)->nullable(false)->default("");
            $table->string('password',60)->nullable(false)->default("");
            $table->integer('smtp')->nullable(false)->default(1);
            $table->integer('authenticate')->nullable(false)->default(1);
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
        Schema::dropIfExists('master_mail_senders');
    }
}
