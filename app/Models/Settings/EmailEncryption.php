<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;


class EmailEncryption extends Model
{
    protected $table = 'email_encryption_type';
    protected $guarded = [];
}