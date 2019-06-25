<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class localAuth extends Model
{
    protected $table = 'master_local_auths';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
