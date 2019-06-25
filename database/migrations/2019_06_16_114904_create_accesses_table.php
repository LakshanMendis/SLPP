<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_access', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable(false)->default(0);
            $table->string('username',40)->nullable(false)->default("");
            $table->string('password',60)->nullable(false)->default("");
            $table->integer('overrided_company')->nullable(true);
            $table->integer('overrided_location')->nullable(true);
            $table->integer('overrided_department')->nullable(true);
            $table->integer('overrided_designation')->nullable(true);
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
        Schema::dropIfExists('master_access');
    }
}
