<?php

namespace App\Http\Controllers;

use App\ward;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = array();

        if (isset($request->local_auth_id) && !empty($request->local_auth_id)){
            $where[0] = array('status','=',1);
            
            if ($request->local_auth_id != 1){
                $where[1] = array('local_auth_id','=',$request->local_auth_id);
            }
        }else{
            $where[0] = array('status','=',1);
        }

        $all_active_wards = ward::where($where)
        ->orderBy('name', 'asc')
        ->get()
        ->jsonSerialize();

        return response($all_active_wards, Response::HTTP_OK);
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
     * @param  \App\ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function show(ward $ward)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function edit(ward $ward)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ward $ward)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function destroy(ward $ward)
    {
        //
    }
}
