<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',20)->nullable(false)->default("");
            $table->string('name',60)->nullable(false)->default("");
            $table->string('url',80)->nullable(false)->default("");
            $table->string('internal_menu_url',80)->nullable(false)->default("");
            $table->string('icon',40)->nullable(false)->default("");
            $table->integer('main_module')->nullable(false)->default(0);
            $table->integer('parent_module_code')->nullable(false)->default(0);
            $table->integer('is_in_menu')->nullable(false)->default(0);
            $table->integer('menu_level')->nullable(false)->default(1);
            $table->integer('openable')->nullable(false)->default(0);
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
        Schema::dropIfExists('master_modules');
    }
}
