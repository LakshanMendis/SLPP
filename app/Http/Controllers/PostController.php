<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function sms(Request $request)
    {
        $province = $request->input('select_province');
        $district = $request->input('select_district');
        $electorate = $request->input('select_electorate');
        $local_auth = $request->input('select_local_auth');
        $ward = $request->input('select_ward');
        $gn_div = $request->input('select_gn');
        $categories = $request->input('categories');
        $template = $request->input('template_id');
        $language = $request->input('language_id');

        $query = "";
        $where = "";
        $result_array = array();

        if (isset($categories)){
            foreach ($categories as $key => $category) {
                $category_obj = json_decode($category);
                $category_id = $category_obj->id;
                $category_value = $category_obj->value;
    
                if ($category_value == NULL) {
                    continue;
                }
    
                $where .= (empty($where)) ? " WHERE ( " : " AND ( ";
                $where .= " MAP.category_id = ".$category_id." AND MAP.option_id = ".$category_value." ";
                $where .= " ) ";
            }
        }

        $where .= (empty($where)) ? " WHERE ( " : " AND ( ";
        $where .= " MEM.province_id = ".$province." AND ";
        $where .= " MEM.district_id = ".$district." AND ";
        $where .= " MEM.electorate_id = ".$electorate." AND ";
        $where .= " MEM.local_auth_id = ".$local_auth." AND ";
        $where .= " MEM.ward_id = ".$ward." AND ";
        $where .= " MEM.gn_id = ".$gn_div." ";
        $where .= " ) ";

        $where .= (empty($where)) ? " WHERE ( " : " AND ( ";
        $where .= " MEM.mobile1 != '' ";
        $where .= " ) ";

        $this_template_id = $template;

        $query_template = "SELECT
        TEM.is_base_template AS IS_BASE,
        TEM.base_template AS BASE_TEM_ID,
        TEM.`language` AS LANG_ID
        FROM
        slpp_templates AS TEM
        WHERE
        TEM.id = ?
        LIMIT 1";

        $result_template = DB::select($query_template, [$this_template_id]);

        $is_base_template = $result_template[0]->IS_BASE;
        $base_template_id = $result_template[0]->BASE_TEM_ID;

        if ($is_base_template == 1) {
            $base_template_id = $this_template_id;
        }

        if ($language == 0){
            $query_language_group = " SELECT
            MEM.`pref_lang_id` AS LANG_ID
            FROM
            slpp_members AS MEM
            LEFT JOIN slpp_member_category_maps AS MAP ON MEM.id = MAP.member_id ".$where." GROUP BY MEM.`pref_lang_id`";

            $result_language_group = DB::select($query_language_group);

            $i = 0;

            foreach ($result_language_group as $language){
                $lang_id = $language->LANG_ID;

                $query_template_fetch = "SELECT
                TEM.content AS CONTENT
                FROM
                slpp_templates AS TEM
                WHERE
                TEM.base_template = ? AND
                TEM.`language` = ? AND
                TEM.`status` = 1
                LIMIT 1";

                $result_template_fetch = DB::select($query_template_fetch, [$base_template_id, $lang_id]);

                $template_content = $result_template_fetch[0]->CONTENT;

                if ($template_content != NULL){
                    $where .= (empty($where)) ? " WHERE ( " : " AND ( ";
                    $where .= " MEM.pref_lang_id = '$lang_id' ";
                    $where .= " ) ";

                    $member_query = " SELECT
                    MEM.mobile1 AS MOBILE_NO
                    FROM
                    slpp_members AS MEM
                    LEFT JOIN slpp_member_category_maps AS MAP ON MEM.id = MAP.member_id ".$where;

                    $member_result = DB::select($member_query);

                    $result_array[$i]['mobile'] = $member_result;
                    $result_array[$i]['template'] = $template_content;
                }

                $i++;
            }
        }else{
            $query_template_fetch = "SELECT
            TEM.content AS CONTENT
            FROM
            slpp_templates AS TEM
            WHERE
            TEM.base_template = ? AND
            TEM.`language` = ? AND
            TEM.`status` = 1
            LIMIT 1";

            $result_template_fetch = DB::select($query_template_fetch, [$base_template_id, $language]);

            $template_content = $result_template_fetch[0]->CONTENT;

            if ($template_content != NULL){
                $where .= (empty($where)) ? " WHERE ( " : " AND ( ";
                $where .= " MEM.pref_lang_id = '$lang_id' ";
                $where .= " ) ";

                $member_query = " SELECT
                MEM.mobile1 AS MOBILE_NO
                FROM
                slpp_members AS MEM
                LEFT JOIN slpp_member_category_maps AS MAP ON MEM.id = MAP.member_id ".$where;

                $member_result = DB::select($member_query);

                $result_array[0]['mobile'] = $member_result;
                $result_array[0]['template'] = $template_content;
            }
        }

        
        return response($result_array, Response::HTTP_OK);
    }

    public function print(Request $request)
    {
        $province = $request->input('select_province');
        $district = $request->input('select_district');
        $electorate = $request->input('select_electorate');
        $local_auth = $request->input('select_local_auth');
        $ward = $request->input('select_ward');
        $gn_div = $request->input('select_gn');
        $categories = $request->input('categories');
        $template = $request->input('template_id');
        $language = $request->input('language_id');

        $query = "";
        $where = "";

        if (isset($categories)){
            foreach ($categories as $key => $category) {
                $category_obj = json_decode($category);
                $category_id = $category_obj->id;
                $category_value = $category_obj->value;
    
                if ($category_value == NULL) {
                    continue;
                }
    
                $where .= (empty($where)) ? " WHERE ( " : " AND ( ";
                $where .= " MAP.category_id = ".$category_id." AND MAP.option_id = ".$category_value." ";
                $where .= " ) ";
            }
        }

        $where .= (empty($where)) ? " WHERE ( " : " AND ( ";
        $where .= " MEM.province_id = ".$province." AND ";
        $where .= " MEM.district_id = ".$district." AND ";
        $where .= " MEM.electorate_id = ".$electorate." AND ";
        $where .= " MEM.local_auth_id = ".$local_auth." AND ";
        $where .= " MEM.ward_id = ".$ward." AND ";
        $where .= " MEM.gn_id = ".$gn_div." ";
        $where .= " ) ";

        $query = " SELECT
        COUNT(MEM.id) AS C
        FROM
        slpp_members AS MEM
        LEFT JOIN slpp_member_category_maps AS MAP ON MEM.id = MAP.member_id ".$where;

        $result = DB::select($query);

        return response($result, Response::HTTP_OK);
    }

    public function email(Request $request)
    {
        $province = $request->input('select_province');
        $district = $request->input('select_district');
        $electorate = $request->input('select_electorate');
        $local_auth = $request->input('select_local_auth');
        $ward = $request->input('select_ward');
        $gn_div = $request->input('select_gn');
        $categories = $request->input('categories');
        $template = $request->input('template_id');
        $language = $request->input('language_id');

        $query = "";
        $where = "";

        if (isset($categories)){
            foreach ($categories as $key => $category) {
                $category_obj = json_decode($category);
                $category_id = $category_obj->id;
                $category_value = $category_obj->value;
    
                if ($category_value == NULL) {
                    continue;
                }
    
                $where .= (empty($where)) ? " WHERE ( " : " AND ( ";
                $where .= " MAP.category_id = ".$category_id." AND MAP.option_id = ".$category_value." ";
                $where .= " ) ";
            }
        }

        $where .= (empty($where)) ? " WHERE ( " : " AND ( ";
        $where .= " MEM.province_id = ".$province." AND ";
        $where .= " MEM.district_id = ".$district." AND ";
        $where .= " MEM.electorate_id = ".$electorate." AND ";
        $where .= " MEM.local_auth_id = ".$local_auth." AND ";
        $where .= " MEM.ward_id = ".$ward." AND ";
        $where .= " MEM.gn_id = ".$gn_div." ";
        $where .= " ) ";

        $query = " SELECT
        COUNT(MEM.id) AS C
        FROM
        slpp_members AS MEM
        LEFT JOIN slpp_member_category_maps AS MAP ON MEM.id = MAP.member_id ".$where;

        $result = DB::select($query);

        return response($result, Response::HTTP_OK);
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
