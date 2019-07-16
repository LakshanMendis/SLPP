<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    protected $table = 'master_permissions';
    const CREATED_AT = 'created_at';
}
