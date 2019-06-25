<?php

namespace App\Http\Controllers;

use App\religion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReligionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_active_religions = religion::where('status', 1)
        ->orderBy('name', 'asc')
        ->get()
        ->jsonSerialize();

        return response($all_active_religions, Response::HTTP_OK);
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
     * @param  \App\religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function show(religion $religion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function edit(religion $religion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, religion $religion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function destroy(religion $religion)
    {
        //
    }
}
