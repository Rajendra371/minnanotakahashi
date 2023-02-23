<?php

namespace App\Models\Employee;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use  Illuminate\Foundation\Auth\User as Authenticatable;


class Employee extends Authenticatable
{

    use SoftDeletes;

    protected $guard = 'employee';

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function generateEmployeeCode()
    {
        $count = Employee::count();
        if ($count) {
            $empcode = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $empcode = '0001';
        }
        return $empcode;
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Employee\Department');
    }

    public function designation()
    {
        return $this->belongsTo('App\Models\Employee\Designation');
    }

    public function gender()
    {
        return $this->belongsTo('App\Models\Employee\Gender');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Employee\EmployeeType', 'employee_type_id', 'id');
    }

    public function roster()
    {
        return $this->hasMany('App\Models\Roster\RosterMaster', 'empid');
    }

    public function rosterdetails()
    {
        return $this->hasMany('App\Models\Roster\RostersDetail', 'empid');
    }

    public function trainings()
    {
        return $this->belongsToMany('App\Models\Training\Training')->withPivot('attachment')->withTimestamps();
    }

    public static function getDatatableList(Request $request)
    {
        $defaultpicker = get_constant_value('DEFAULT_DATEPICKER');
        $get = $request->all();
        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($value, ENT_QUOTES));
        }

        $location_id = $request->location_id;
        $department_id = $request->department_id;
        $designation_id = $request->designation_id;
        $employee_id = $request->employee_id;
        $gender_id = $request->gender_id;
        $employee_type_id = $request->employee_type_id;
        $emp_status = $request->emp_status;
        $search_text = $get['search_text'];


        if (empty($location_id)) {
            if (isset(auth()->user()->group_id) && auth()->user()->group_id != 1) {
                $location_id = auth()->user()->locationid ?? '';
            }
        }

        $limit = 20;
        $offset = 0;
        if (!empty($request->iDisplayLength)) {
            $limit = $request->iDisplayLength;
            $offset = $request->iDisplayStart;
        }

        $nquery = DB::table('employees as e')
            ->leftjoin('department as dep', 'dep.id', '=', 'e.department_id')
            ->leftjoin('designation as des', 'des.id', '=', 'e.designation_id')
            ->leftjoin('employee_type as et', 'et.id', '=', 'e.employee_type_id')
            ->leftjoin('gender as g', 'g.id', '=', 'e.gender_id')
            ->select('e.id');
        $query = DB::table('employees  as e')
            ->leftjoin('department as dep', 'dep.id', '=', 'e.department_id')
            ->leftjoin('designation as des', 'des.id', '=', 'e.designation_id')
            ->leftjoin('employee_type as et', 'et.id', '=', 'e.employee_type_id')
            ->leftjoin('gender as g', 'g.id', '=', 'e.gender_id')
            ->select('e.id', 'e.empcode', DB::raw("CONCAT(e.first_name,' ',IFNULL(e.middle_name,''),' ',e.last_name) as employee_name"), 'e.mobile1', 'e.email', 'depcode', 'depname', 'designation_name', 'gend_name', 'nationality', 'status', 'et.employee_type');

        if (!empty($emp_status)) {
            $nquery->where('e.status', '=', $emp_status);
            $query->where('e.status', '=', $emp_status);
        }
        if (!empty($department_id)) {
            $nquery->where('e.department_id', '=', $department_id);
            $query->where('e.department_id', '=', $department_id);
        }
        if (!empty($designation_id)) {
            $nquery->where('e.designation_id', '=', $designation_id);
            $query->where('e.designation_id', '=', $designation_id);
        }
        if (!empty($employee_id)) {
            $nquery->where('e.id', '=', $employee_id);
            $query->where('e.id', '=', $employee_id);
        }
        if (!empty($gender_id)) {
            $nquery->where('e.gender_id', '=', $gender_id);
            $query->where('e.gender_id', '=', $gender_id);
        }
        if (!empty($employee_type_id)) {
            $nquery->where('e.employee_type_id', '=', $employee_type_id);
            $query->where('e.employee_type_id', '=', $employee_type_id);
        }

        if (!empty($location_id)) {
            $nquery->where('e.locationid', '=', $location_id);
            $query->where('e.locationid', '=', $location_id);
        }

        if (!empty($search_text)) {

            $nquery->where(function ($qry) use ($search_text) {
                return $qry->where('first_name', 'like', "%" . $search_text . "%")
                    ->orWhere('middle_name', 'like', "%" .  $search_text . "%")
                    ->orWhere('last_name', 'like', "%" .  $search_text . "%")
                    ->orWhere('empcode', 'like', "%" .  $search_text . "%")
                    ->orWhere('email', 'like', "%" .  $search_text . "%")
                    ->orWhere('mobile1', 'like', "%" .  $search_text . "%");
            });

            $query->where(function ($qry) use ($search_text) {
                return $qry->where('first_name', 'like', "%" . $search_text . "%")
                    ->orWhere('middle_name', 'like', "%" .  $search_text . "%")
                    ->orWhere('last_name', 'like', "%" .  $search_text . "%")
                    ->orWhere('empcode', 'like', "%" .  $search_text . "%")
                    ->orWhere('email', 'like', "%" .  $search_text . "%")
                    ->orWhere('mobile1', 'like', "%" .  $search_text . "%");
            });
        }


        if (!empty($get['sSearch_1'])) {
            $nquery->where('e.empcode', 'like', "%" . $get['sSearch_1'] . "%");
            $query->where('e.empcode', 'like', "%" . $get['sSearch_1'] .  "%");
        }
        if (!empty($get['sSearch_2'])) {
            $search_2 = $get['sSearch_2'];
            $nquery->where(function ($qry) use ($search_2) {
                return $qry->where('first_name', 'like', "%" . $search_2 . "%")
                    ->orWhere('middle_name', 'like', "%" .  $search_2 . "%")
                    ->orWhere('last_name', 'like', "%" .  $search_2 . "%");
            });

            $query->where(function ($qry) use ($search_2) {
                return $qry->where('first_name', 'like', "%" . $search_2 . "%")
                    ->orWhere('middle_name', 'like', "%" .  $search_2 . "%")
                    ->orWhere('last_name', 'like', "%" .  $search_2 . "%");
            });
        }

        if (!empty($get['sSearch_3'])) {
            $nquery->where('gend_name', 'like', "%" . $get['sSearch_3'] . "%");
            $query->where('gend_name', 'like', "%" . $get['sSearch_3'] . "%");
        }
        if (!empty($get['sSearch_4'])) {
            $nquery->where('depname', 'like', "%" . $get['sSearch_4'] . "%");
            $query->where('depname', 'like', "%" . $get['sSearch_4'] . "%");
        }
        if (!empty($get['sSearch_5'])) {
            $nquery->where('designation_name', 'like', "%" . $get['sSearch_5'] . "%");
            $query->where('designation_name', 'like', "%" . $get['sSearch_5'] . "%");
        }
        if (!empty($get['sSearch_6'])) {
            $nquery->where('mobile1', 'like', "%" . $get['sSearch_6'] . "%");
            $query->where('mobile1', 'like', "%" . $get['sSearch_6'] . "%");
        }
        if (!empty($get['sSearch_7'])) {
            $nquery->where('email', 'like', "%" . $get['sSearch_7'] . "%");
            $query->where('email', 'like', "%" . $get['sSearch_7'] . "%");
        }
        if (!empty($get['sSearch_8'])) {
            $nquery->where('employee_type', 'like', "%" . $get['sSearch_8'] . "%");
            $query->where('employee_type', 'like', "%" . $get['sSearch_8'] . "%");
        }

        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'e.empcode';
        }

        if ($get['iSortCol_0'] == 2) {
            $order_by = 'e.first_name';
        }
        if ($get['iSortCol_0'] == 3) {
            $order_by = 'gend_name';
        }
        if ($get['iSortCol_0'] == 4) {
            $order_by = 'depname';
        }
        if ($get['iSortCol_0'] == 5) {
            $order_by = 'designation_name';
        }
        if ($get['iSortCol_0'] == 6) {
            $order_by = 'e.mobile1';
        }
        if ($get['iSortCol_0'] == 7) {
            $order_by = 'e.email';
        }
        if ($get['iSortCol_0'] == 8) {
            $order_by = 'employee_type';
        }

        if (!empty($order) && !empty($order_by)) {
            $query->orderBy($order_by, $order);
        } else {
            $query->orderBy('e.id', 'DESC');
        }
        if (!empty($offset)) {
            $query->offset($offset);
        }

        if ($limit) {
            $query->limit($limit);
        }

        $data = $query->get();
        $count = $nquery->count();

        // $no_of_pages = ceil($count / $limit);

        if ($count > 0) {
            $ndata = $data;
            $ndata['totalrecs'] = $count;
            $ndata['totalfilteredrecs'] = $count;
        } else {
            $ndata = array();
            $ndata['totalrecs'] = 0;
            $ndata['totalfilteredrecs'] = 0;
        }
        return $ndata;
    }
}