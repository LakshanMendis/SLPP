<?php

namespace App\Http\Controllers;

use App\user;
use App\access;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
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
    public function create(Request $request)
    {
        $user = new user;

        $user->emp_no = (!isset($request->employee_no)) ? "" : $request->input('employee_no');
        $user->epf_no = (!isset($request->epf_no)) ? "" : $request->input('epf_no');
        $user->firstname = (!isset($request->firstname)) ? "" : $request->input('firstname');
        $user->lastname = (!isset($request->lastname)) ? "" : $request->input('lastname');
        $user->gender = (!isset($request->gender)) ? "" : $request->gender;
        $user->dob = $request->dob;
        $user->nic = (!isset($request->nic)) ? "" : $request->nic;;
        $user->company_id = 1;
        $user->location_id = (!isset($request->location)) ? "" : $request->location;
        $user->department_id = (!isset($request->department)) ? "" : $request->department;
        $user->designation_id = (!isset($request->designation)) ? "" : $request->designation;
        $user->mobile_no = (!isset($request->mobile)) ? "" : $request->mobile;
        $user->email = (!isset($request->email)) ? "" : $request->email;
        $user->joined_at = $request->joined_at;
        $user->left_at = $request->left_at;
        $user->status = $request->status;

        $user->save();

        return response($user->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function search(Request $request)
    {
        $matching_users = array();

        if (isset($request->search) && !empty($request->search)){
            $term = $request->search;
            $company_id = 1;

            $search_query = "SELECT
            ACC.id AS `access_id`,
            USR.id AS `user_id`,
            USR.emp_no,
            USR.epf_no,
            USR.firstname,
            USR.lastname,
            USR.gender,
            USR.dob,
            USR.nic,
            USR.mobile_no,
            USR.email
            FROM
            master_access AS ACC
            INNER JOIN master_users AS USR ON ACC.user_id = USR.id
            WHERE
            ACC.`status` = 1 AND
            USR.`status` = 1 AND
            USR.company_id = $company_id AND
            (ACC.username LIKE '%$term%' OR
            USR.emp_no LIKE '%$term%' OR
            USR.epf_no LIKE '%$term%' OR
            USR.firstname LIKE '%$term%' OR
            USR.lastname LIKE '%$term%')
            ORDER BY
            USR.firstname ASC,
            USR.lastname ASC";

            $matching_users = DB::select($search_query);
        }

        return response($matching_users, Response::HTTP_OK);
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
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }
}
