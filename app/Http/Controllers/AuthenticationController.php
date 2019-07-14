<?php

namespace App\Http\Controllers;

use App\access;
use App\User;
use App\module;
use App\permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthenticationController extends Controller
{   
    /**
     * Login check
     */
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $enc_password = sha1($password);

        $result_array = array();
        $result = false;
        $data = array();
        $debug = "";
        $message = "";

        try {
            $access_count = access::select()
            ->where('username', '=', $username)
            ->where('password', '=', $enc_password)
            ->where('status', '=', 1)
            ->count();

            if ($access_count > 0) {
                $access = access::select(
                    'id as access_id',
                    'user_id',
                    'overrided_company as company_id',
                    'overrided_location as location_id',
                    'overrided_department as department_id',
                    'overrided_designation as designation_id',
                    'status'
                )
                ->where('username', '=', $username)
                ->where('password', '=', $enc_password)
                ->where('status', '=', 1)
                ->first();
    
                $data = $access;

                $result = true;
            }
        } catch (Throwable $th) {
            $debug = "";
            $message = "";
        }
        
        $result_array['result'] = $result;
        $result_array['debug'] = $debug;
        $result_array['message'] = $message;
        $result_array['data'] = $data;

        return $result_array;
    }

    public function menu(Request $request) 
    {
        $access_id = (isset($request->access_id)) ? $request->input('access_id') : 0;

        $result_array = array();
        $result = false;
        $data = array();
        $debug = "";
        $message = "";

        if ($access_id > 0) {
            $level1_array = array();
            $level1_count = 0;

            $fetch_1st_level_query = "SELECT
            `MOD`.id,
            `MOD`.`code` AS `index`,
            `MOD`.`name` AS `header`,
            `MOD`.url AS link,
            `MOD`.icon AS iconName,
            `MOD`.openable AS openable
            FROM
            master_permissions AS PERM
            INNER JOIN master_modules AS `MOD` ON PERM.module_id = `MOD`.id
            WHERE
            PERM.access_id = ? AND
            `MOD`.`status` = 1 AND
            `MOD`.is_in_menu = 1 AND
            `MOD`.main_module = 1 AND
            `MOD`.menu_level = 1
            GROUP BY
            PERM.module_id
            ORDER BY
            `id` ASC";

            $fetch_1st_level_res = DB::select($fetch_1st_level_query, [$access_id]);

            foreach ($fetch_1st_level_res as $level1_row) {
                $level2_array = array();
                $level2_count = 0;

                $parent_module_id = $level1_row->id;

                $level1_array[$level1_count]['key'] = $parent_module_id;
                $level1_array[$level1_count]['index'] = $level1_row->index;
                $level1_array[$level1_count]['header'] = $level1_row->header;
                $level1_array[$level1_count]['link'] = $level1_row->link;
                $level1_array[$level1_count]['iconName'] = $level1_row->iconName;
                $level1_array[$level1_count]['isHeader'] = ($level1_row->openable === 0) ? true : false;

                $fetch_2nd_level_query = "SELECT
                `MOD`.id,
                `MOD`.`code` AS `index`,
                `MOD`.`name` AS `header`,
                `MOD`.url AS link,
                `MOD`.icon AS iconName,
                `MOD`.openable AS openable
                FROM
                master_permissions AS PERM
                INNER JOIN master_modules AS `MOD` ON PERM.module_id = `MOD`.id
                WHERE
                PERM.access_id = ? AND
                `MOD`.`status` = 1 AND
                `MOD`.is_in_menu = 1 AND
                `MOD`.main_module = 0 AND
                `MOD`.parent_module_code = ? AND
                `MOD`.menu_level = 2
                GROUP BY
                PERM.module_id
                ORDER BY
                `id` ASC";

                $fetch_2nd_level_res = DB::select($fetch_2nd_level_query, [$access_id, $parent_module_id]);

                foreach ($fetch_2nd_level_res as $level2_row) {
                    $level2_array[$level2_count]['header'] = $level2_row->header;
                    $level2_array[$level2_count]['link'] = $level2_row->link;

                    $level2_count++;
                }

                if ($level2_count > 0){
                    $level1_array[$level1_count]['childrenLinks'] = $level2_array;
                }

                $level1_count++;
            }

            if ($level1_count > 0){
                $result = true;
                $data = $level1_array;
            }
        }

        $result_array['result'] = $result;
        $result_array['debug'] = $debug;
        $result_array['message'] = $message;
        $result_array['data'] = $data;

        return $result_array;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
