<?php

namespace App\Models\Delivery;
use Illuminate\Support\Facades\Input;
use DB;

use Illuminate\Database\Eloquent\Model;

class DeliveryDetail extends Model
{
    protected $table = 'product_ass_deliverydetail';
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
