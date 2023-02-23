<?php
namespace App\Models\Settings;
use Illuminate\Database\Eloquent\Model;
use DB;
class Blog extends Model
{
protected $table='blog_category';
protected $guarded = [];
public function parent()
    {
       return $this->hasOne('App\Models\Settings\Blog', 'id', 'blog_parent_category')
       ->Select('id','blog_parent_category','displaytext as value','displaytext as label','displaytext as title');
    }
    public function children(){
       return $this->hasMany('App\Models\Settings\Blog', 'blog_parent_category', 'id')
       ->Select('id' ,'blog_parent_category','displaytext as value','displaytext as label','displaytext as title');
        }
    public static function tree() {
       return static::with(implode('.',array_fill(0, 4, 'children')))
       ->where('blog_parent_category', '=','0')
       ->Select('id','blog_parent_category','displaytext as value','displaytext as label','displaytext as title')
       ->get();
        }
    public static function getTableData($page_size, $page, $sorted, $filtered){
          $softwareid=auth()->user()->softwareid;
        if($page == 0){
            $start_page = 0;
        }else{
            $start_page = ($page*$page_size);
        }
        $query = DB::table('blog_category as  b')
                ->leftJoin('blog_category as s', 's.id', '=', 'b.blog_parent_category')
                ->select( DB::raw('(CASE WHEN(b.blog_parent_category<>0) THEN  s.displaytext ELSE "--" END)  as parentm '), 'b.*')
                ->where('b.softwareid',$softwareid);

        $nquery = DB::table('blog_category as b')
                ->leftJoin('blog_category  as s', 's.id', '=', 'b.blog_parent_category')
                 ->select( DB::raw('(CASE WHEN(b.blog_parent_category<>0) THEN  s.displaytext ELSE "--" END)  as parentm '), 'b.*')
                  ->where('b.softwareid',$softwareid);
        if(!empty($start_page)){
            $query->offset($start_page);
        }
        if($page_size){
            $query->limit($page_size);
        }
        if(!empty($filtered)){
            // echo "<pre></pre>";
            // print_r($filtered);
            // die();
            foreach($filtered as $filter){
                $query->where('b.'.$filter['id'],'like',"%".$filter['value']."%");
                $nquery->where('b.'.$filter['id'],'like',"%".$filter['value']."%");
            }
        }
        if(!empty($sorted)){
            foreach($sorted as $sort){
                $sort_by = $sort['desc'];

                if($sort_by == true){
                    $sort_type = 'DESC';
                }else{
                    $sort_type = 'ASC';
                }
                $query->orderBy($sort['id'],$sort_type);
                $nquery->orderBy($sort['id'],$sort_type);
            }
        }
        $data = $query->get();
        $i = 0;
        $array = array();
        foreach($data as $key=>$row){
            $array[$i]['id'] = $row->id;
            $array[$i]['blog_parent_category'] = $row->parentm;
            $array[$i]['displaytext'] = $row->displaytext;
            $array[$i]['displaytextnp'] = $row->displaytextnp;
            $array[$i]['bloglink'] = $row->modulelink;
            $array[$i]['icon'] = $row->icon;
            $i++;
        }
        $all_filtered_data = $nquery->get();
        $count = count($all_filtered_data);
        $no_of_pages = ceil($count/$page_size);
        return array('rows'=>$array,'pages'=>$no_of_pages);
    }
}
