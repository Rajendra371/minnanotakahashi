<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;


class EmailProtocol extends Model
{
    protected $table = 'email_protocol_type';
    protected $guarded = [];
}