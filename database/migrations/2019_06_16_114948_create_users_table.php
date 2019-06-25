<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('emp_no',20)->nullable(false)->default("");
            $table->string('epf_no',20)->nullable(false)->default("");
            $table->string('firstname',60)->nullable(false)->default("");
            $table->string('lastname',60)->nullable(false)->default("");
            $table->string('gender',10)->nullable(false)->default("");
            $table->date('dob')->nullable(true);
            $table->string('nic',20)->nullable(false)->default("");
            $table->integer('company_id')->nullable(false)->default(0);
            $table->integer('location_id')->nullable(false)->default(0);
            $table->integer('department_id')->nullable(false)->default(0);
            $table->integer('designation_id')->nullable(false)->default(0);
            $table->string('mobile_no',20)->nullable(false)->default("");
            $table->string('email',60)->nullable(false)->default("");
            $table->string('profile_pic_path',60)->nullable(true);
            $table->integer('immediate')->nullable(false)->default(0);
            $table->integer('dep_head')->nullable(false)->default(0);
            $table->integer('high')->nullable(false)->default(0);
            $table->integer('alter1')->nullable(false)->default(0);
            $table->integer('alter2')->nullable(false)->default(0);
            $table->date('joined_at')->nullable(true);
            $table->date('left_at')->nullable(true);
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
        Schema::dropIfExists('master_users');
    }
}
