<?php

namespace App\Http\Controllers\Api\Menu;

use App\Models\Settings\Module;
use App\Models\Menus\Menus;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRequest;
use DB;

class MenuController extends Controller
{

    public function __construct(Request $request)
    {
        $this->adjacencyList = "";
        $this->adjacencyCheckboxlist = "";
        $this->menuList = "";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('menu m')
            ->leftJoin('menu s', 's.id', '=', 'm.menu_parent')
            ->select(DB::raw('(CASE WHEN(m.menu_parent<>0) THEN  s.menu_name ELSE "--" END)  as parentm '), 'm.*')
            ->get($data);

        // echo "<pre>";
        // print_r($data);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //     check_permission('Insert');
        //   die();

        $validator = Validator::make($request->all(), [
            'menu_name' => 'required',
            'menu_order' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->all();
        // echo "<pre>";
        // print_r($input);
        // die();

        $menuid = $request->get('id');
        $menu_ismain = !empty($request->get('menu_ismain')) ? 'Y' : 'N';
        $menu_istop = !empty($request->get('menu_istop')) ? 'Y' : 'N';
        $menu_isfooter = !empty($request->get('menu_isfooter')) ? 'Y' : 'N';
        $menu_isactive = !empty($request->get('menu_isactive')) ? 'Y' : 'N';
        $softwareid = auth()->user()->softwareid;
        $createdby = auth()->user()->id;

        //  $softwareid=auth()->user()->softwareid;

        unset($input['id']);
        unset($input['menu_ismain']);
        unset($input['menu_istop']);
        unset($input['menu_isfooter']);
        unset($input['menu_isactive']);

        $input['menu_ismain'] = $menu_ismain;
        $input['menu_istop'] = $menu_istop;
        $input['menu_isfooter'] = $menu_isfooter;
        $input['menu_isactive'] = $menu_isactive;

        // echo "<pre>";
        // print_r($input);
        // die();
        $menu_name = $request->get('menu_name');
        $menu_slug = strtolower(preg_replace('/\s+/', '-', $menu_name));
        if ($menuid) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }

            $data = Menus::where('id', $menuid)->first();
            // echo "<pre>";
            // print_r($data);
            // die();
            $input['menu_slug'] = $menu_slug;
            $input['updated_at'] = datetime();
            $input['updatedip'] = get_real_ipaddr();
            $input['updatedmac'] = get_Mac_Address();
            $input['updatedby'] = $createdby;

            save_log('menu', 'id', $menuid, $input, 'Update');
            // die();
            if ($data->update($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Updated Successfully!!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
            }
        } else {
            $trans = check_permission('Insert');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            $input['menu_slug'] = $menu_slug;
            $input['createdip'] = get_real_ipaddr();
            $input['createdmac'] = get_Mac_Address();
            $input['softwareid'] = $softwareid;
            $input['createdby'] = $createdby;


            if ($data = Menus::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    // public function edit(Request $request)
    // {
    //     $trans = check_permission('Update');
    //     if ($trans == 'error') {
    //         permission_message();
    //         exit;
    //     }
    //     $id = $request->get('id');
    //     $softwareid = auth()->user()->softwareid;
    //     $data = Menus::where('id', $id)->where('softwareid', $softwareid)->first();
    //     $menu_data = '<a href="javascript:void(0)"  data-url="/api/menu/getmenu"></a>';
    //     // echo $menu_data;
    //     // die;
    //     $view = view("Menu/Menu")
    //     ->with('data',$data);

    //     $template = $view->render();
    //     if ($data) {
    //         return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
    //     } else {
    //         return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
    //     }
    // }
    public function edit(Request $request)
    {
        $trans = check_permission('Update');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $softwareid = auth()->user()->softwareid;
        $data = Menus::where('id', $id)->where('softwareid', $softwareid)->first();
        if ($data) {
            return response()->json(['status' => 'success', 'data' => $data, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $softwareid = auth()->user()->softwareid;
        save_log('menu', 'id', $id, false, 'Delete');
        $data = Menus::where('id', $id)->where('softwareid', $softwareid)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
    /* For permisson dynamic select module*/
    public function get_menu()
    {
        $menu_data = '';
        $menu_data .= '<select name="menu_parent" onChange={this.handleChanges} value={this.state.menu_parent} class="form-control"> <option value="0">--Select--</option>';
        $menu_data .= $this->menu_adjacency(0, 0, 0, 0);
        $menu_data .= '</select>';
        // echo $menu_data;
        // echo "<pre>";
        // print_r($menu_data);
        // die();
        if ($menu_data) {
            return response()->json(['data' => $menu_data, 'status' => 'success', 'message' => 'Record Fetched Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
    public function menu_adjacency($id, $parent, $parent_id, $level)
    {
        $softwareid = auth()->user()->softwareid;
        $query = DB::table('menu')
            ->where('menu_parent', '=', $parent_id)
            ->where('softwareid', $softwareid)
            // ->orderby('ASC')
            ->get();
        $oMenus = $query;
        //$this->adjacencyList.="";
        foreach ($oMenus as $value) :
            $this->adjacencyList .= "<option value=" . $value->id;
            if ($parent == $value->id)
                $this->adjacencyList .= " selected";
            $this->adjacencyList .= ">" . str_repeat('  &minus; ', $level) . stripslashes($value->menu_name) . "</option>";
            $this->menu_adjacency($id, $parent, $value->id,  $level + 1);
        endforeach;
        return $this->adjacencyList;
    }

    public function get_module()
    {
        $array = Menus::tree();
        //   echo "<pre>";
        //   print_r($array);
        //   die();
        $array = $this->removeElementWithValue($array, 'children', '[]');
        return response()->json($array);
    }

    public function removeElementWithValue($array, $key, $value)
    {
        foreach ($array as $subKey => $firstArray) {
            foreach ($firstArray[$key] as $subKey => $secondArray) {
                foreach ($secondArray[$key] as $subKey => $thirdArray) {
                    foreach ($thirdArray[$key] as $subKey => $fourthArray) {
                        if ($fourthArray[$key] == $value)
                            unset($fourthArray[$key]);
                        $fourthArray[$key] = $this->status();
                    }
                    if ($thirdArray[$key] == $value)
                        unset($thirdArray[$key]);
                    $thirdArray[$key] = $this->status();
                }
                if ($secondArray[$key] == $value)
                    unset($secondArray[$key]);
                $secondArray[$key] = $this->status();
            }
            if ($firstArray[$key] == $value)
                unset($firstArray[$key]);
            $firstArray[$key] = $this->status();
        }
        return $array;
    }

    /** For Datatable */
    public function getTableData(Request $request)
    {
        $trans = check_permission('View');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $page_size = $request->get('pageSize');
        $page = $request->get('page');
        $sorted = $request->get('sorted');
        $filtered = $request->get('filtered');
        $data = Menus::getTableData($page_size, $page, $sorted, $filtered);
        return response()->json($data);
    }
    /* For dynamic Siderbar */
    public function show_menu()
    {
        $otherinfo = $this->otherinformation();
        // echo"<pre>";
        // print_r($otherinfo);
        // die();

        $array = Menu::tree();

        // echo"<pre>";
        // print_r($array);
        // die();
        $array = $this->removeMenuElementWithValue($array, 'children', '[]');
        return response()->json(array('items' => $array, 'otherinfo' => $otherinfo));
    }
    public function tab_menu(Request $request)
    {
        $groupid = auth()->user()->group_id;
        $softwareid = auth()->user()->softwareid;

        $urlchk = $request->get('url');
        $urlchk = str_replace('/badministrator', '', $urlchk);
        $data = DB::select("SELECT m.*,(CASE WHEN(m.modulelink='" . $urlchk . "') THEN 'cur' ELSE 'non_cur' END) as urlstatus
            FROM
                modules m
            JOIN modulespermission as mp ON mp.moduleid = m.id
            WHERE
                m.parentmodule IN (
                    SELECT
                        parentmodule
                    FROM
                        modules ms
                    WHERE
                        ms.modulelink = '" . $urlchk . "'
                )
            AND m.modulelink != '#'
            AND m.parentmodule != '0'
            AND m.isactive = 'Y'
            AND mp.usergroupid = " . $groupid . "
            AND m.softwareid = " . $softwareid . "
            ORDER BY `order` ASC");
        // echo "<pre>";
        // print_r($data);
        // die();
        return response()->json(['data' => $data, 'status' => 'success', 'message' => 'Record Fetched Successfully!!']);
    }

    public function otherinformation()
    {
        $orgid = auth()->user()->orgid;
        $locationid = auth()->user()->locationid;
        $softwareid = auth()->user()->softwareid;

        $result = DB::table('orgsoftware as os')
            ->join('software as  s', 's.id', '=', 'os.softwareid')
            ->join('organization as o', 'o.id', '=', 'os.locationid')
            ->join('location as l', 'l.id', '=', 'os.orgid')
            ->where('os.orgid', $orgid)
            ->where('os.locationid', $locationid)
            ->where('s.id', $softwareid)
            ->select('o.orgname', 'o.orgaddress1', 'o.orgaddress2', 'o.contact', 'o.email', 'o.website', 's.softwarename', 'l.locname', 'l.ismain')
            ->first();

        if (!empty($result)) {
            return $result;
        }
        return array();
    }

    public function removeMenuElementWithValue($array, $key, $value)
    {
        foreach ($array as $subKey => $firstArray) {
            foreach ($firstArray[$key] as $subKey => $secondArray) {
                foreach ($secondArray[$key] as $subKey => $thirdArray) {
                    foreach ($thirdArray[$key] as $subKey => $fourthArray) {
                        if ($fourthArray[$key] == $value)
                            unset($fourthArray[$key]);
                    }
                    if ($thirdArray[$key] == $value)
                        unset($thirdArray[$key]);
                }
                if ($secondArray[$key] == $value)
                    unset($secondArray[$key]);
            }
            if ($firstArray[$key] == $value)
                unset($firstArray[$key]);
        }
        return $array;
    }

    public function getAllMenusOrder($id = NULL, $level = 0, $first_call = true)
    {
        $this->menuList .=  $first_call == true ? '<ol class="sortable">' : '<ol>';
        $call = $first_call == true ? false : false;
        $id = isset($id) ? $id : 0;
        $objectMenu = array();

        $query = DB::table('modules')
            ->where('parentmodule', '=', $id)
            ->orderBy('order', 'ASC')
            ->get();
        if ($query->count() > 0) {
            $objectMenu = $query;
        }

        foreach ($objectMenu as  $tbl_value) :
            $menu_id = $tbl_value->id;
            $menu_title = stripslashes($tbl_value->displaytext);
            $menu_order = $tbl_value->order;
            $this->menuList .= '<li id="list_' . $menu_id . '"><div><span class="disclose"><span></span></span>' . $menu_title . '</div>';
            $this->getAllMenusOrder($menu_id, $level + 1, false);
            $this->menuList .= '</li>';
        endforeach;
        $this->menuList .=  '</ol>';
        return $this->menuList;
    }

    public function showmenuorder()
    {
        // echo "test";
        // die();
        $array = MenuOrder::tree();
        $array = $this->removeMenuElementWithValue($array, 'children', '[]');
        return response()->json($array);
    }
    public function updateallmoduleorder(Request $request)
    {

        $list = $request->get('treeData');

        $trans = $this->module_order_update($list, true, 0);
        if ($trans) {
            return response()->json(['status' => 'success', 'message' => 'Order Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }



    public function module_order_update($datalist = false, $firstcall = false, $prntid = false)
    {
        $i = 1;
        if (!empty($datalist)) {
            foreach ($datalist as $mnu) {

                $children = !empty($mnu['children']) ? $mnu['children'] : array();
                $id = $mnu['id'];

                $paretdid_db = !empty($mnu['parentmodule']) ? $mnu['parentmodule'] : 0;
                $parentId = $paretdid_db;
                if ($firstcall == true) {
                    $dataArray = array(
                        'order' => $i,
                        'parentmodule' => 0
                    );
                    DB::table('modules')
                        ->where('id', $id)
                        ->update($dataArray);
                    if (!empty($children)) {
                        $this->module_order_update($children, false, $id);
                    }
                } else {

                    // $parentId=$mnu['id'][$i];
                    $dataArray = array(
                        'order' => $i,
                        'parentmodule' => $prntid
                    );
                    if (!empty($children)) {
                        DB::table('modules')
                            ->where('id', $id)
                            ->update($dataArray);
                        $this->module_order_update($children, false, $id);
                    } else {
                        $dataArray = array(
                            'order' => $i,
                            'parentmodule' => $prntid
                        );
                        DB::table('modules')
                            ->where('id', $id)
                            ->update($dataArray);
                    }
                }

                $i++;
            }
        }
        return true;
    }

    public function getModalData(Request $request)
    {
        $id = $request->get('id');
        $data = Menus::where('id', $id)->first();
        // echo "<pre>";
        // print_r($data);
        // die();
        if ($data) {
            $title = !empty($data[0]->menu_name) ? $data[0]->menu_name : 'View Menu';
            $view = view("Menu/MenuView")->with('data', $data);

            $template = $view->render();

            if ($data) {
                return response()->json(['status' => 'success', 'message' => 'Data Available', 'title' => $title, 'template' => $template]);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
            }
        } else {
            return false;
        }
    }

    public function menu_view(Request $request)
    {
        $trans = check_permission('View');

        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $data = Menus::where('id', $id)->first();
        $menu_data = Menus::select('id', 'menu_parent', 'menu_name')->get();

        $view = view("Menu/MenuView")
            ->with('data', $data)->with('menu_data', $menu_data);

        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function menu_list(Request $request)
    {
        $date_type = get_constant_value('DEFAULT_DATEPICKER');

        $data = Menus::get_menu_list();
        // echo "<pre>";
        // print_r($data);
        // die();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $i = 0;
        $array = array();
        foreach ($data as $key => $row) {

            $current_date = strtotime(CURDATE_EN);

            $array[$i]['id'] = $row->id;
            $array[$i]['menu_name'] = $row->menu_name;
            $array[$i]['menu_typeid'] = $row->menu_typeid;
            $array[$i]['menu_url'] = $row->menu_url;
            if ($row->menu_ismain == 'Y') {
                $main = 'Main,';
            } else {
                $main = '';
            }
            if ($row->menu_istop == 'Y') {
                $top = 'Top,';
            } else {
                $top = '';
            }
            if ($row->menu_isfooter == 'Y') {
                $footer = 'Footer';
            } else {
                $footer = '';
            }
            $array[$i]['menu_ismain'] = $main . '' . $top . '' . $footer;



            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/menu/edit" data-id=' . $row->id . ' data-targetForm="menuForm" data-edittype="template"><i class="fa fa-edit"></i></a>

            <a href="javascript:void(0)" class="view" data-url="/api/menu/menu_view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>

            <a href="javascript:void(0)" class="btnDelete" data-url="/api/menu/menu_delete" data-id=' . $row->id . ' data-targetForm="menuForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';

            $i++;
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }
}