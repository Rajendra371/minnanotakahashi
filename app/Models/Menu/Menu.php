<?php

namespace App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
class Menu extends Model
{
   protected $table='modules';

   public function __construct()
    {            
            // echo $this->lang;
            // die();
    }
    public function parent(){
      $admin_path = get_constant_value("ADMIN_PATH");
      $groupid= auth()->user()->group_id;  
      $headerlist=getallheaders();
       $lang='en';
       if($lang=='ne')
       {
          $select='modules.displaytextnp as name';
       }
       else
       {
          $select='modules.displaytext as name';
       }
       return $this->hasOne('App\Models\Menu\Menu', 'id', 'parentmodule')
       ->Select('modules.id','modules.parentmodule', $select,\DB::raw('(CASE WHEN (modules.parentmodule > 0 ) THEN CONCAT("'.$admin_path.'",modulelink) ELSE modulelink END) as url'),'modules.icon')
       ->from('modules')
       ->join('modulespermission','modulespermission.moduleid', '=', 'modules.id')
       ->where('hasaccess','1')
       ->where('usergroupid',$groupid)
       ->where('isactive','Y')
       ->where('ishidden','N')
       ->OrderBy('order','ASC');
    }
    public function children(){
      $admin_path = get_constant_value("ADMIN_PATH");
       $groupid= auth()->user()->group_id;  
       $headerlist=getallheaders();
       $lang='en';
       if($lang=='ne')
       {
          $select='modules.displaytextnp as name';
       }
       else
       {
          $select='modules.displaytext as name';
       }
       return $this->hasMany('App\Models\Menu\Menu', 'parentmodule', 'id')
       ->Select('modules.id','modules.parentmodule',$select,\DB::raw('(CASE WHEN (modules.parentmodule > 0 ) THEN CONCAT("'.$admin_path.'",modulelink) ELSE modulelink END) as url'),'modules.icon')
        ->from('modules')
       ->join('modulespermission','modulespermission.moduleid', '=', 'modules.id')
       ->where('hasaccess','1')
       ->where('usergroupid',$groupid)
       ->where('isactive','Y')
       ->where('ishidden','N')
       ->OrderBy('order','ASC');
        }

    public static function tree() {

       $groupid= auth()->user()->group_id;  
       $headerlist=getallheaders();
      //  $lang=$headerlist['language'];
       $lang='en';
       if($lang=='ne')
       {
          $select='modules.displaytextnp as name';
       }
       else
       {
          $select='modules.displaytext as name';
       }
       $tree=static::with(implode('.',array_fill(0, 4, 'children')))
       ->Select('modules.id','modules.parentmodule',$select,'modules.modulelink as url','modules.icon')
       ->from('modules')
       ->join('modulespermission','modulespermission.moduleid', '=', 'modules.id')
       ->where('modules.parentmodule','=','0')
       ->where('hasaccess','1')
       ->where('usergroupid',$groupid)
       ->where('isactive','Y')
       ->where('ishidden','N')
       ->OrderBy('order','ASC')
       ->get();
      //  print_r($tree);
      //  die();
       return $tree;

        }

}



