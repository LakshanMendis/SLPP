<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class title extends Model
{
    protected $table = 'master_titles';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
