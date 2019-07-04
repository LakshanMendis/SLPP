<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slpp_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',60)->nullable(false)->default("");
            $table->integer('language')->nullable(true);
            $table->date('template_date')->nullable(true);
            $table->string('target',20)->nullable(true);
            $table->text('content')->nullable(true);
            $table->integer('is_base_template')->nullable(false)->default(1);
            $table->integer('base_template')->nullable(true);
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
        Schema::dropIfExists('templates');
    }
}
