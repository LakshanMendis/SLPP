<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ward extends Model
{
    protected $table = 'master_wards';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
