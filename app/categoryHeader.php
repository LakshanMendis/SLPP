<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoryHeader extends Model
{
    protected $table = 'slpp_category_headers';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
