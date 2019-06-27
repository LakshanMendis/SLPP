<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    protected $table = 'slpp_members';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
