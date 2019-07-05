<?php

namespace App\Http\Controllers;

use App\location;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        switch ($query){
            case 'all':
                $result = location::orderBy('location', 'asc')
                ->get()
                ->jsonSerialize();
            break;

            case 'all-active':
                $result = location::where('status','=',1)
                ->orderBy('location', 'asc')
                ->get()
                ->jsonSerialize();
            break;

            case 'all-inactive':
                $result = location::where('status','=',0)
                ->orderBy('location', 'asc')
                ->get()
                ->jsonSerialize();
            break;

            default:
                $result = location::where('status','=',1)
                ->orderBy('location', 'asc')
                ->get()
                ->jsonSerialize();
            break;
        }

        return response($result, Response::HTTP_OK);
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
     * @param  \App\location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(location $location)
    {
        //
    }
}
