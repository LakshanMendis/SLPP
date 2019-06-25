<?php

namespace App\Http\Controllers;

use App\gramaseva;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GramasevaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = array();

        if (isset($request->ward_id) && !empty($request->ward_id)){
            $where[0] = array('status','=',1);
            
            if ($request->ward_id != 1){
                $where[1] = array('ward_id','=',$request->ward_id);
            }
        }else{
            $where[0] = array('status','=',1);
        }

        $all_active_gramasevas = gramaseva::where('status', 1)
        ->orderBy('name', 'asc')
        ->get()
        ->jsonSerialize();

        return response($all_active_gramasevas, Response::HTTP_OK);
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
     * @param  \App\gramaseva  $gramaseva
     * @return \Illuminate\Http\Response
     */
    public function show(gramaseva $gramaseva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\gramaseva  $gramaseva
     * @return \Illuminate\Http\Response
     */
    public function edit(gramaseva $gramaseva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\gramaseva  $gramaseva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, gramaseva $gramaseva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\gramaseva  $gramaseva
     * @return \Illuminate\Http\Response
     */
    public function destroy(gramaseva $gramaseva)
    {
        //
    }
}
