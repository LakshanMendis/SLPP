<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slpp_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('membership_id',40)->unique();
            $table->integer('title_id')->nullable(true);
            $table->string('firstname',60)->nullable(false)->default("");
            $table->string('lastname',60)->nullable(false)->default("");
            $table->string('callingname',40)->nullable(false)->default("");
            $table->string('image_path',100)->nullable(true);
            $table->string('nic',20)->nullable(false)->default("");
            $table->integer('nationality_id')->nullable(false)->default(1);
            $table->integer('religion_id')->nullable(false)->default(1);
            $table->text('remarks')->nullable(true);
            $table->integer('province_id')->nullable(false)->default(1);
            $table->integer('district_id')->nullable(false)->default(1);
            $table->integer('electorate_id')->nullable(false)->default(1);
            $table->integer('local_auth_id')->nullable(false)->default(1);
            $table->integer('ward_id')->nullable(false)->default(1);
            $table->integer('gn_id')->nullable(false)->default(1);
            $table->string('address_line1',80)->nullable(false)->default("");
            $table->string('address_line2',80)->nullable(true);
            $table->string('city',40)->nullable(false)->default("");
            $table->string('postal_code',20)->nullable(false)->default("");
            $table->string('mobile1',20)->nullable(false)->default("");
            $table->string('mobile2',20)->nullable(true);
            $table->string('home_phone',20)->nullable(false)->default("");
            $table->string('office_phone',20)->nullable(false)->default("");
            $table->string('fax',20)->nullable(false)->default("");
            $table->string('email',60)->nullable(false)->default("");
            $table->integer('pref_lang_id')->nullable(false)->default(1);
            $table->string('pref_lang_name',100)->nullable(false)->default("")->charset('utf8')->collation('utf8_unicode_ci');
            $table->string('pref_lang_address_line1',100)->nullable(false)->default("")->charset('utf8')->collation('utf8_unicode_ci');
            $table->string('pref_lang_address_line2',100)->nullable(true)->charset('utf8')->collation('utf8_unicode_ci');
            $table->string('pref_lang_city',60)->nullable(false)->default("")->charset('utf8')->collation('utf8_unicode_ci');
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
        Schema::dropIfExists('slpp_members');
    }
}
