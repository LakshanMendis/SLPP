<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class district extends Model
{
    protected $table = 'master_districts';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
