<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class template extends Model
{
    protected $table = 'slpp_templates';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
