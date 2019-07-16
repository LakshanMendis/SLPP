<?php

namespace App\Http\Controllers;

use App\permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $req = (isset($request->r)) ? $request->r : "";
        $aid = (isset($request->access_id)) ? $request->access_id : 0;
        $uid = (isset($request->user_id)) ? $request->user_id : 0;

        $result_array = array();
        $data = array();
        $menu_permissions_array = array();
        $other_permissions_array = array();
        $result = true;
        $debug = "";
        $message = "";

        switch ($req) {
            case 'all-active':
                $menu_level1_array = array();
                $menu_level1_count = 0;

                $menu_level1_query = "SELECT
                `MOD`.id,
                `MOD`.`code`,
                `MOD`.`name`,
                `MOD`.icon
                FROM
                master_modules AS `MOD`
                WHERE
                `MOD`.`status` = 1 AND
                `MOD`.is_in_menu = 1 AND
                `MOD`.main_module = 1 AND
                `MOD`.menu_level = 1";

                $menu_level1_res = DB::select($menu_level1_query);

                foreach ($menu_level1_res as $level1_item) {
                    $menu_level2_array = array();
                    $menu_level2_count = 0;

                    $parent_module_id = $level1_item->id;
                    $menu_level1_array[$menu_level1_count]['id'] = $parent_module_id;
                    $menu_level1_array[$menu_level1_count]['code'] = $level1_item->code;
                    $menu_level1_array[$menu_level1_count]['name'] = $level1_item->name;
                    $menu_level1_array[$menu_level1_count]['icon'] = $level1_item->icon;

                    $menu_level2_query = "SELECT
                    `MOD`.id,
                    `MOD`.`code`,
                    `MOD`.`name`,
                    `MOD`.icon
                    FROM
                    master_modules AS `MOD`
                    WHERE
                    `MOD`.`status` = 1 AND
                    `MOD`.is_in_menu = 1 AND
                    `MOD`.main_module = 0 AND
                    `MOD`.menu_level = 2 AND
                    `MOD`.parent_module_code = $parent_module_id";

                    $menu_level2_res = DB::select($menu_level2_query);

                    foreach ($menu_level2_res as $level2_item) {
                        $menu_level2_array[$menu_level2_count]['id'] = $level2_item->id;
                        $menu_level2_array[$menu_level2_count]['parent_id'] = $parent_module_id;
                        $menu_level2_array[$menu_level2_count]['code'] = $level2_item->code;
                        $menu_level2_array[$menu_level2_count]['name'] = $level2_item->name;
                        $menu_level2_array[$menu_level2_count]['icon'] = $level2_item->icon;

                        $menu_level2_count++;
                    }

                    if ($menu_level2_count > 0){
                        $menu_level1_array[$menu_level1_count]['children'] = $menu_level2_array;
                    }

                    $menu_level1_count++;
                }

                if ($menu_level1_count > 0){
                    $menu_permissions_array = $menu_level1_array;
                }

                $other_permission_count = 0;

                $other_permission_query = "SELECT
                `MOD`.id,
                `MOD`.`code`,
                `MOD`.`name`
                FROM
                master_modules AS `MOD`
                WHERE
                `MOD`.`status` = 1 AND
                `MOD`.is_in_menu = 0";

                $other_permission_res = DB::select($other_permission_query);

                foreach ($other_permission_res as $other_item) {
                    $other_permissions_array[$other_permission_count]['id'] = $other_item->id;
                    $other_permissions_array[$other_permission_count]['code'] = $other_item->code;
                    $other_permissions_array[$other_permission_count]['name'] = $other_item->name;

                    $other_permission_count++;
                }
            break;

            case 'accesswise-active':
                $access_id = (isset($request->access_id)) ? $request->input('access_id') : 0;

                if ($access_id > 0){
                    $count_exist_permissions = DB::table('master_permissions')
                    ->where('access_id','=',$access_id)
                    ->count();

                    if ($count_exist_permissions > 0){
                        $module_max_query = DB::table('master_modules')->max('id');

                        // Menu permissions
                        for ($i = 0; $i <= $module_max_query; $i++) {
                            $check_query = "SELECT
                            COUNT(PRM.id) AS `c`
                            FROM
                            master_permissions AS PRM
                            INNER JOIN master_modules AS `MOD` ON PRM.module_id = `MOD`.id
                            WHERE
                            PRM.access_id = $access_id AND
                            PRM.module_id = $i AND
                            `MOD`.is_in_menu = 1 AND
                            `MOD`.`status` = 1";

                            $check_res = DB::select($check_query);
                            $is_exist = ($check_res[0]->c > 0) ? true : false;

                            $menu_permissions_array[$i] = ($is_exist) ? $i : null;
                        }

                        // Other permissions
                        for ($i = 0; $i <= $module_max_query; $i++) {
                            $check_query = "SELECT
                            COUNT(PRM.id) AS `c`
                            FROM
                            master_permissions AS PRM
                            INNER JOIN master_modules AS `MOD` ON PRM.module_id = `MOD`.id
                            WHERE
                            PRM.access_id = $access_id AND
                            PRM.module_id = $i AND
                            `MOD`.is_in_menu = 0 AND
                            `MOD`.`status` = 1";

                            $check_res = DB::select($check_query);
                            $is_exist = ($check_res[0]->c > 0) ? true : false;

                            $other_permissions_array[$i] = ($is_exist) ? $i : null;
                        }
                    }
                } else {
                    $debug = "No selected user";
                    $message = "No selected user";
                }
            break;

            case 'userwise-active':
            break;

            default:
            break;
        }

        $data['menu'] = $menu_permissions_array;
        $data['other'] = $other_permissions_array;

        $result_array['result'] = $result;
        $result_array['data'] = $data;
        $result_array['message'] = $message;
        $result_array['debug'] = $debug;

        return response($result_array, Response::HTTP_OK);
    }

    public function save(Request $request)
    {
        $aid = (isset($request->access_id)) ? $request->access_id : 0;
        $menu_permissions = (isset($request->menu_permissions)) ? $request->menu_permissions : [];
        $other_permissions = (isset($request->other_permissions)) ? $request->other_permissions : [];

        $result_array = array();
        $result = false;
        $message = "";
        $debug = "";

        if ($aid > 0) {
            DB::table('master_permissions')->where('access_id', '=', $aid)->delete();

            foreach($menu_permissions as $module_id) {
                if ($module_id != null) {
                    DB::table('master_permissions')->insert([
                        'access_id' => $aid,
                        'module_id' => $module_id
                    ]);
                }
            }

            foreach($other_permissions as $module_id) {
                if ($module_id != null) {
                    DB::table('master_permissions')->insert([
                        'access_id' => $aid,
                        'module_id' => $module_id
                    ]);
                }
            }

            $result = true;
        } else {
            $message = "No user selected";
            $debug = "No user selected";
        }

        $result_array['result'] = $result;
        $result_array['message'] = $message;
        $result_array['debug'] = $debug;

        return response($result_array, Response::HTTP_OK);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(permission $permission)
    {
        //
    }
}
