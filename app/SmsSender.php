<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsSender extends Model
{
    protected $table = 'master_sms_senders';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
