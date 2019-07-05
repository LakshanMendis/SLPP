<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailSender extends Model
{
    protected $table = 'master_mail_senders';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
