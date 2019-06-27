<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    protected $table = 'master_locations';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
