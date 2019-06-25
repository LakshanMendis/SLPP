<?php

namespace App\Http\Controllers;

use App\province;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_active_provinces = province::where('status', 1)
        ->orderBy('name', 'asc')
        ->get()
        ->jsonSerialize();

        return response($all_active_provinces, Response::HTTP_OK);
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
     * @param  \App\province  $province
     * @return \Illuminate\Http\Response
     */
    public function show(province $province)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\province  $province
     * @return \Illuminate\Http\Response
     */
    public function edit(province $province)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\province  $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, province $province)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy(province $province)
    {
        //
    }
}
