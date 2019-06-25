<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nationality extends Model
{
    protected $table = 'master_nationalities';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
