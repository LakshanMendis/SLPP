<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slpp_category_headers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category',40)->nullable(false)->default("");
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
        Schema::dropIfExists('slpp_category_headers');
    }
}
