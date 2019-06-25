<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class province extends Model
{
    protected $table = 'master_provinces';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
