<?php

namespace App\Http\Controllers;

use App\categoryHeader;
use App\categoryDetail;
use App\memberCategoryMap;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result_array = array();
        $inc_cat = 0;
        
        $header_query = "SELECT
        HEADER.`id` AS `ID`,
        HEADER.category AS `NAME`
        FROM
        slpp_category_headers AS HEADER
        WHERE
        HEADER.`status` = ?
        ORDER BY
        `NAME` ASC";

        $all_active_categories = DB::select($header_query, [1]);

        foreach ($all_active_categories as $category) {
            $options = array();
            $inc_opt = 0;
            $cat_id = $category->ID;
            $cat_name = $category->NAME;

            $result_array[$inc_cat]['id'] = $cat_id;
            $result_array[$inc_cat]['textId'] = 'select-cat-'.$cat_id;
            $result_array[$inc_cat]['label'] = $cat_name;

            $detail_query = "SELECT
            DETAIL.id AS ID,
            DETAIL.`option` AS `NAME`
            FROM
            slpp_category_details AS DETAIL
            WHERE
            DETAIL.category_id = ? AND
            DETAIL.`status` = ?
            ORDER BY
            `NAME` ASC";

            $all_active_options = DB::select($detail_query, [$cat_id, 1]);

            foreach ($all_active_options as $option) {
                $options[$inc_opt]['id'] = $option->ID;
                $options[$inc_opt]['name'] = $option->NAME;

                $inc_opt++;
            }

            $result_array[$inc_cat]['options'] = $options;

            $inc_cat++;
        }

        return response($result_array, Response::HTTP_OK);
    }

    public function values(Request $request)
    {
        $result_array = array();
        $inc_cat = 0;

        if (isset($request->member_id) && !empty($request->member_id) && $request->member_id != 0){
            $member_id = $request->member_id;

            $header_query = "SELECT
            HEADER.`id` AS `ID`,
            HEADER.category AS `NAME`
            FROM
            slpp_category_headers AS HEADER
            WHERE
            HEADER.`status` = ?
            ORDER BY
            `NAME` ASC";

            $all_active_categories = DB::select($header_query, [1]);

            foreach ($all_active_categories as $category) {
                $selected_options = array();
                $inc_opt = 0;
                $cat_id = $category->ID;

                $result_array[$inc_cat]['id'] = $cat_id;

                $detail_query = "SELECT
                DETAIL.id AS `ID`,
                DETAIL.`option` AS `NAME`
                FROM
                slpp_member_category_maps AS MAPPING
                INNER JOIN slpp_category_details AS DETAIL ON MAPPING.category_id = DETAIL.category_id AND MAPPING.option_id = DETAIL.id
                WHERE
                DETAIL.`status` = ? AND
                MAPPING.member_id = ? AND
                MAPPING.category_id = ?
                ORDER BY
                `NAME` ASC";

                $all_selected_options = DB::select($detail_query, [1, $member_id, $cat_id]);

                foreach ($all_selected_options as $option) {
                    $selected_options[$inc_opt]['id'] = $option->ID;
                    $selected_options[$inc_opt]['name'] = $option->NAME;

                    $inc_opt++;
                }

                $result_array[$inc_cat]['value'] = $selected_options;

                $inc_cat++;
            }
        }else{
            $header_query = "SELECT
            HEADER.`id` AS `ID`,
            HEADER.category AS `NAME`
            FROM
            slpp_category_headers AS HEADER
            WHERE
            HEADER.`status` = ?
            ORDER BY
            `NAME` ASC";

            $all_active_categories = DB::select($header_query, [1]);

            foreach ($all_active_categories as $category) {
                $cat_id = $category->ID;

                $result_array[$inc_cat]['id'] = $cat_id;
                $result_array[$inc_cat]['value'] = null;

                $inc_cat++;
            }
        }

        return response($result_array, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $member_id = (isset($request->member_id)) ? $request->member_id : 0;
        $values = (isset($request->values)) ? $request->values : [];

        if ($member_id > 0) {
            if (count($values) > 0) {
                $map_records_delete = memberCategoryMap::where('member_id', $member_id)->delete();

                foreach ($values as $category) {
                    $cat_obj = json_decode($category);

                    $cat_id = $cat_obj->id;
                    $selected_options = (isset($cat_obj->value)) ? $cat_obj->value : [];

                    if (count($selected_options) > 0){
                        foreach ($selected_options as $option) {
                            $opt_id = $option->id;

                            $map_record = new memberCategoryMap;

                            $map_record->member_id = $member_id;
                            $map_record->category_id = $cat_id;
                            $map_record->option_id = $opt_id;
                            $map_record->created_by = 0;

                            $map_record->save();
                        }
                    }
                }
            }
        }

        return response([], Response::HTTP_CREATED);
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
