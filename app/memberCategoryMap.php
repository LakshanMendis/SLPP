<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class memberCategoryMap extends Model
{
    protected $table = 'slpp_member_category_maps';
    public $timestamps = false;
    const CREATED_AT = 'created_at';
}
