<?php

namespace App\Http\Controllers;

use App\electorate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ElectorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = array();

        if (isset($request->province_id) && !empty($request->province_id)){
            $where[0] = array('status','=',1);
            
            if ($request->province_id != 1){
                $where[1] = array('province_id','=',$request->province_id);
            }
        }else{
            $where[0] = array('status','=',1);
        }

        $all_active_electorates = electorate::where($where)
        ->orderBy('name', 'asc')
        ->get()
        ->jsonSerialize();

        return response($all_active_electorates, Response::HTTP_OK);
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
     * @param  \App\electorate  $electorate
     * @return \Illuminate\Http\Response
     */
    public function show(electorate $electorate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\electorate  $electorate
     * @return \Illuminate\Http\Response
     */
    public function edit(electorate $electorate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\electorate  $electorate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, electorate $electorate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\electorate  $electorate
     * @return \Illuminate\Http\Response
     */
    public function destroy(electorate $electorate)
    {
        //
    }
}
