<?php

namespace App\Models\Roster;

use Illuminate\Database\Eloquent\Model;
use DB;
use Symfony\Component\HttpFoundation\Request;

class RosterBook extends Model
{
    protected $table = 'shift_book';
    protected $guarded = [];

    public function shift_detail()
    {
        return $this->belongsTo('App\Models\Roster\RosterDetail', 'shift_detailid');
    }

    public function shift_master()
    {
        return $this->belongsTo('App\Models\Roster\RosterMaster', 'shift_masterid');
    }

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee\Employee', 'empid');
    }
}