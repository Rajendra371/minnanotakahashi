<?php
namespace App\Models\Settings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;


class SiteSetting extends Model
{
    protected $table = 'language';
    protected $guarded = [];
}
