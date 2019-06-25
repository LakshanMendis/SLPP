<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class language extends Model
{
    protected $table = 'master_languages';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
