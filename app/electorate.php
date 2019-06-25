<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class electorate extends Model
{
    protected $table = 'master_electorates';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
