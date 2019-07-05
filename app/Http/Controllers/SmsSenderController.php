<?php

namespace App\Http\Controllers;

use App\SmsSender;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SmsSenderController extends Controller
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
                $result = SmsSender::orderBy('name', 'asc')
                ->get()
                ->jsonSerialize();
            break;

            case 'all-active':
                $result = SmsSender::where('status','=',1)
                ->orderBy('name', 'asc')
                ->get()
                ->jsonSerialize();
            break;

            case 'all-inactive':
                $result = SmsSender::where('status','=',0)
                ->orderBy('name', 'asc')
                ->get()
                ->jsonSerialize();
            break;

            default:
                $result = SmsSender::where('status','=',1)
                ->orderBy('name', 'asc')
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
     * @param  \App\SmsSender  $smsSender
     * @return \Illuminate\Http\Response
     */
    public function show(SmsSender $smsSender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SmsSender  $smsSender
     * @return \Illuminate\Http\Response
     */
    public function edit(SmsSender $smsSender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SmsSender  $smsSender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmsSender $smsSender)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SmsSender  $smsSender
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmsSender $smsSender)
    {
        //
    }
}
