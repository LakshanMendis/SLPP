<?php

namespace App\Http\Controllers;

use App\MailSender;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MailSenderController extends Controller
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
                $result = MailSender::orderBy('caption', 'asc')
                ->get()
                ->jsonSerialize();
            break;

            case 'all-active':
                $result = MailSender::where('status','=',1)
                ->orderBy('caption', 'asc')
                ->get()
                ->jsonSerialize();
            break;

            case 'all-inactive':
                $result = MailSender::where('status','=',0)
                ->orderBy('caption', 'asc')
                ->get()
                ->jsonSerialize();
            break;

            default:
                $result = MailSender::where('status','=',1)
                ->orderBy('caption', 'asc')
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
     * @param  \App\MailSender  $mailSender
     * @return \Illuminate\Http\Response
     */
    public function show(MailSender $mailSender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MailSender  $mailSender
     * @return \Illuminate\Http\Response
     */
    public function edit(MailSender $mailSender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MailSender  $mailSender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MailSender $mailSender)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MailSender  $mailSender
     * @return \Illuminate\Http\Response
     */
    public function destroy(MailSender $mailSender)
    {
        //
    }
}
