<?php

namespace App\Models\Roster;

use Illuminate\Database\Eloquent\Model;
use DB;
use Symfony\Component\HttpFoundation\Request;

class RosterDetail extends Model
{
    protected $table = 'shift_detail';
    protected $guarded = [];

    public function master()
    {
        return $this->belongsTo('App\Models\Roster\RosterMaster', 'shift_masterid');
    }

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee\Employee', 'empid');
    }

    public function shift_book()
    {
        return $this->hasMany('App\Models\Roster\RosterBook', 'shift_detailid');
    }

    public static function get_roster_empwise(Request $request)
    {
    }

    public static function get_roster_datewise(Request $request)
    {
    }

    public static function get_roster_default(Request $request)
    {
    }
}