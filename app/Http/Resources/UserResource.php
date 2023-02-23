<?php

namespace App\Http\Resources;
use DB;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $result=DB::table('orgsoftware as os')
                ->join('software as  s', 's.id', '=', 'os.softwareid')
                ->join('organization as o','o.id', '=', 'os.locationid')
                ->join('location as l','l.id', '=', 'os.orgid')
                ->where('os.orgid',$this->orgid)
                ->where('os.locationid',$this->locationid)
                ->select('o.orgname','o.orgaddress1','o.orgaddress2','s.softwarename','l.locname','l.ismain')
                ->first();

                // echo "<pre>";
                // print_r($result);
                // die();
                $orgname='';
                $orgaddress1='';
                $orgaddress2='';
                $softwarename='';
                $locname='';
                $ismain='';
                if(!empty($result))
                {
                    $orgname=!empty($result->orgname)?$result->orgname:'';
                    $orgaddress1=!empty($result->orgaddress1)?$result->orgaddress1:'';
                    $orgaddress2=!empty($result->orgaddress2)?$result->orgaddress2:'';
                    $softwarename=!empty($result->softwarename)?$result->softwarename:'';
                    $locname=!empty($result->locname)?$result->locname:'';
                    $ismain=!empty($result->ismain)?$result->ismain:'';
                    $depid =!empty($result->depid)?$result->depid:'';
                }

       $retArray= [
            'id' => $this->id,
            'email' => $this->email,
            'username' => $this->username,
            'fullname' => $this->fullname,
            'locationid'=>$this->locationid,
            'softwareid'=>$this->softwareid,
            'orgid'=>$this->orgid,
            'group_id'=>$this->group_id,
            'depid'=>$this->depid,
            'orgname'=>$orgname,
            'orgaddress1'=>$orgaddress1,
            'orgaddress2'=>$orgaddress2,
            'softwarename'=>$softwarename,
            'locname'=>$locname,
            'ismain'=>$ismain,
        ];
        // print_r($retArray);
        // die();
        return $retArray;
    }
}
