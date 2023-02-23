<?php

namespace App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
class MenuOrder extends Model
{
    protected $table='modules';
    public function parent(){
        $softwareid= auth()->user()->softwareid;  
       return $this->hasOne('App\Models\Menu\Menu', 'id', 'parentmodule')
       ->Select('id','parentmodule','modulelink as url','icon','displaytext as title')
       ->where('isactive','Y')
       ->where('softwareid',$softwareid)
       ->OrderBy('order','ASC');
    }
    public function children(){
        $softwareid= auth()->user()->softwareid;  
       return $this->hasMany('App\Models\Menu\Menu', 'parentmodule', 'id')
       ->Select('id','parentmodule','modulelink as url','icon','displaytext as title')
       ->where('isactive','Y')
       ->where('softwareid',$softwareid)
       ->OrderBy('order','ASC');
        }
    public static function tree() {
      $softwareid= auth()->user()->softwareid;  
       return static::with(implode('.',array_fill(0, 4, 'children')))
       ->where('parentmodule', '=','0')
       ->Select('id','parentmodule','modulelink as url','icon','displaytext as title')
       ->where('isactive','Y')
       ->where('softwareid',$softwareid)
       ->OrderBy('order','ASC')
       ->get();
        }

}



