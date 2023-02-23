<?php
namespace App\Models\Settings;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $guarded = [];

    public static function getTableData($page_size, $page, $sorted, $filtered){
        if($page == 0){
            $start_page = 0;
        }else{
            $start_page = ($page*$page_size);
        }

        $query = DB::table('usermain as u')
            ->leftJoin('usergroup  as g', 'g.id', '=', 'u.group_id')
            ->leftJoin('location  as l', 'l.id', '=', 'u.userlocation_id');

        $nquery = DB::table('usergroup as u')
        ->leftJoin('usergroup  as g', 'g.id', '=', 'u.group_id')
        ->leftJoin('location  as l', 'l.id', '=', 'u.userlocation_id');


        if(!empty($start_page)){
            $query->offset($start_page);
        }

        if($page_size){
            $query->limit($page_size);
        }

        if(!empty($filtered)){
            foreach($filtered as $filter){
                $query->where($filter['id'],'like',"%".$filter['value']."%");

                $nquery->where($filter['id'],'like',"%".$filter['value']."%");
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
            $array[$i]['fullname'] = $row->fullname;
            $array[$i]['email'] = $row->email;
            $array[$i]['usergroup'] = $row->usergroup;
            $array[$i]['locname'] = $row->locname;
            $array[$i]['remarks'] = $row->remarks;
            $array[$i]['created_at'] = $row->created_at;
            $array[$i]['action'] = '<a href="javascript:void(0)">Test</a>';
            $i++;
        }

        $all_filtered_data = $nquery->get();
        $count = count($all_filtered_data);

        $no_of_pages = ceil($count/$page_size);

        return array('rows'=>$array,'pages'=>$no_of_pages);
    }
}


