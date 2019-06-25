<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class religion extends Model
{
    protected $table = 'master_religions';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
