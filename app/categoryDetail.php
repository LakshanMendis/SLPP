<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoryDetail extends Model
{
    protected $table = 'slpp_category_details';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
