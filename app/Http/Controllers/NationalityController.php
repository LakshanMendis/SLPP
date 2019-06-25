<?php

namespace App\Http\Controllers;

use App\nationality;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_active_nationalities = nationality::where('status', 1)
        ->orderBy('name', 'asc')
        ->get()
        ->jsonSerialize();

        return response($all_active_nationalities, Response::HTTP_OK);
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
     * @param  \App\nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function show(nationality $nationality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function edit(nationality $nationality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, nationality $nationality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function destroy(nationality $nationality)
    {
        //
    }
}
