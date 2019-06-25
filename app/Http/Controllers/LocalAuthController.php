<?php

namespace App\Http\Controllers;

use App\localAuth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LocalAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = array();

        if (isset($request->district_id) && !empty($request->district_id)){
            $where[0] = array('status','=',1);
            
            if ($request->district_id != 1){
                $where[1] = array('district_id','=',$request->district_id);
            }
        }else{
            $where[0] = array('status','=',1);
        }

        $all_active_local_auths = localAuth::where($where)
        ->orderBy('name', 'asc')
        ->get()
        ->jsonSerialize();

        return response($all_active_local_auths, Response::HTTP_OK);
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
     * @param  \App\localAuth  $localAuth
     * @return \Illuminate\Http\Response
     */
    public function show(localAuth $localAuth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\localAuth  $localAuth
     * @return \Illuminate\Http\Response
     */
    public function edit(localAuth $localAuth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\localAuth  $localAuth
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, localAuth $localAuth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\localAuth  $localAuth
     * @return \Illuminate\Http\Response
     */
    public function destroy(localAuth $localAuth)
    {
        //
    }
}
