<?php

namespace App\Http\Controllers\Api\Blog;

use App\Models\Settings\Blog;
// use App\Models\Menu\Menu;
// use App\Models\Menu\MenuOrder;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRequest;
use DB;

class BlogController extends Controller
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
        $data = DB::table('blog_category m')
            ->leftJoin('blog_category s', 's.id', '=', 'm.blog_parent_category')
            ->select(DB::raw('(CASE WHEN(m.blog_parent_category<>0) THEN  s.displaytext ELSE "--" END)  as parentm '), 'm.*')
            ->get();
        // echo"<pre>";
        // print_r($data);
        // die();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'modulekey' => 'required',
            'displaytext' => 'required',
            'modulelink' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->all();
        $moduleid = $request->get('id');
        $isapproved = !empty($request->get('isapproved')) ? 'Y' : 'N';
        $isinsert = !empty($request->get('isinsert')) ? 'Y' : 'N';
        $isupdate = !empty($request->get('isupdate')) ? 'Y' : 'N';
        $isdelete = !empty($request->get('isdelete')) ? 'Y' : 'N';
        $isview = !empty($request->get('isview')) ? 'Y' : 'N';
        $softwareid = auth()->user()->softwareid;
        $createdby = auth()->user()->id;
        //$softwareid=auth()->user()->softwareid;
        unset($input['id']);
        unset($input['isapproved']);
        unset($input['isinsert']);
        unset($input['isupdate']);
        unset($input['isdelete']);
        unset($input['isview']);
        $input['isapproved'] = $isapproved;
        $input['isinsert'] = $isinsert;
        $input['isupdate'] = $isupdate;
        $input['isdelete'] = $isdelete;
        $input['isview'] = $isview;
        // echo "<pre>";
        // print_r($input);
        // die();
        if ($moduleid) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            $data = Blog::where('id', $moduleid)->first();
            // echo "<pre>";
            // print_r($data);
            // die();
            $input['updated_at'] = datetime();
            $input['updatedip'] = get_real_ipaddr();
            $input['updatedmac'] = get_Mac_Address();
            $input['updatedby'] = $createdby;

            save_log('blog_category', 'id', $moduleid, $input, 'Update');
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

            $input['createdip'] = get_real_ipaddr();
            $input['createdmac'] = get_Mac_Address();
            $input['softwareid'] = $softwareid;
            $input['createdby'] = $createdby;

            if ($data = Module::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $trans = check_permission('Update');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        $softwareid = auth()->user()->softwareid;
        $data = Blog::where('id', $id)->where('softwareid', $softwareid)->first();
        if ($data) {
            return response()->json(['status' => 'success', 'data' => $data, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
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
        save_log('blog_category', 'id', $id, false, 'Delete');
        $data = Blog::where('id', $id)->where('softwareid', $softwareid)->delete();
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
        $menu_data .= '<select name="blog_category@blog_parent_category" onChange={this.handleChanges} value={this.state.blog_parent_category} class="form-control"> <option value="0">--Select--</option>';
        $menu_data .= $this->menu_adjacency(0, 0, 0, 0);
        $menu_data .= '</select>';
        echo "<pre>";
        print_r($menu_data);
        die();
        if ($menu_data) {
            return response()->json(['data' => $menu_data, 'status' => 'success', 'message' => 'Record Fetched Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
    public function menu_adjacency($id, $parent, $parent_id, $level)
    {
        $softwareid = auth()->user()->softwareid;
        $query = DB::table('blog_category')
            ->where('blog_parent_category', '=', $parent_id)
            ->where('softwareid', $softwareid)
            //->orderby('ASC')
            ->get();
        $oMenus = $query;
        // echo"<pre>";
        // print_r($oMenus);
        // die();
        //$this->adjacencyList.="";
        foreach ($oMenus as $value) :
            $this->adjacencyList .= "<option value=" . $value->id;
            if ($parent == $value->id)
                $this->adjacencyList .= "selected";
            $this->adjacencyList .= ">" . str_repeat('  &minus; ', $level) . stripslashes($value->displaytext) . "</option>";
            $this->menu_adjacency($id, $parent, $value->id,  $level + 1);
        endforeach;
        return $this->adjacencyList;
    }
    public function get_module()
    {
        $array = Blog::tree();
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

        $data = Blog::getTableData($page_size, $page, $sorted, $filtered);

        return response()->json($data);
    }

    /* For dynamic Siderbar */
    public function show_menu()
    {
        $otherinfo = $this->otherinformation();
        // print_r($otherinfo);
        // die();
        $array = Menu::tree();
        $array = $this->removeMenuElementWithValue($array, 'children', '[]');

        return response()->json(array('items' => $array, 'otherinfo' => $otherinfo));
    }
    public function tab_menu(Request $request)
    {
        $urlchk = $request->get('url');
        $data = DB::select("SELECT m.*,(CASE WHEN(m.modulelink='" . $urlchk . "') THEN 'cur' ELSE 'non_cur' END) as urlstatus
            FROM
                blog_category m
            WHERE
                m.blog_parent_category IN (
                    SELECT
                        blog_parent_category
                    FROM
                        blog_category ms
                    WHERE
                        ms.modulelink = '" . $urlchk . "'
                )
            AND m.modulelink != '#'
            AND blog_parent_category != '0'
            AND isactive = 'Y'
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

        $query = DB::table('blog_category')
            ->where('blog_parent_category', '=', $id)
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

                $paretdid_db = !empty($mnu['blog_parent_category']) ? $mnu['blog_parent_category'] : 0;
                $parentId = $paretdid_db;
                if ($firstcall == true) {
                    $dataArray = array(
                        'order' => $i,
                        'blog_parent_category' => 0
                    );
                    DB::table('blog_category')
                        ->where('id', $id)
                        ->update($dataArray);
                    if (!empty($children)) {
                        $this->module_order_update($children, false, $id);
                    }
                } else {

                    // $parentId=$mnu['id'][$i];
                    $dataArray = array(
                        'order' => $i,
                        'blog_parent_category' => $prntid
                    );
                    if (!empty($children)) {
                        DB::table('blog_category')
                            ->where('id', $id)
                            ->update($dataArray);
                        $this->module_order_update($children, false, $id);
                    } else {
                        $dataArray = array(
                            'order' => $i,
                            'blog_parent_category' => $prntid
                        );
                        DB::table('blog_category')
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
        $data = Blog::where('id', $id)->first();
        if ($data) {
            $title = !empty($data[0]->displaytext) ? $data[0]->displaytext : 'View Module';
            $view = view("settings/view_module")->with('data', $data);
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
}