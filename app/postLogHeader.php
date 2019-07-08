<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class postLogHeader extends Model
{
    protected $table = 'slpp_post_log_headers';
    const CREATED_AT = 'created_at';
}
