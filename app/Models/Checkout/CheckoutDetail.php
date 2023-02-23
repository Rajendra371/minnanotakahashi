<?php

namespace App\Models\Checkout;

use Illuminate\Database\Eloquent\Model;

class CheckoutDetail extends Model
{
    protected $table = 'product_checkout_detail';
    protected $guarded = [];

    protected $hidden = [
        'postdatead',
        'postdatebs',
        'posttime',
        'postip',
        'postmac',
        'modifyby',
        'modifydatead',
        'modifydatebs',
        'modifytime',
        'modifyip',
        'modifymac',
        'created_at',
        'updated_at',
    ];  
}
