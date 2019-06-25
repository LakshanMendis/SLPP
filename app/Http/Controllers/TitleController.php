<?php

namespace App\Http\Controllers;

use App\title;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_active_titles = title::where('status', 1)
        ->orderBy('name', 'asc')
        ->get()
        ->jsonSerialize();

        return response($all_active_titles, Response::HTTP_OK);
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
     * @param  \App\title  $title
     * @return \Illuminate\Http\Response
     */
    public function show(title $title)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\title  $title
     * @return \Illuminate\Http\Response
     */
    public function edit(title $title)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\title  $title
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, title $title)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\title  $title
     * @return \Illuminate\Http\Response
     */
    public function destroy(title $title)
    {
        //
    }
}
