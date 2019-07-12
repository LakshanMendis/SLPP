<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class access extends Model
{
    protected $table = 'master_access';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
