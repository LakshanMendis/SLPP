<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $table = 'master_users';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
