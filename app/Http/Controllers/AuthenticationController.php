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
