<?php

namespace App\Http\Controllers;

use App\access;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = (!isset($request->user_id)) ? 0 : $request->input('user_id');
        $username = (!isset($request->username)) ? "" : $request->input('username');
        $password = (!isset($request->password)) ? "" : $request->input('password');

        if ($user_id > 0 && !empty($username) && !empty($password)) {
            $enc_password = sha1($password);

            $access = new access;

            $access->user_id = $user_id;
            $access->username = $username;
            $access->password = $enc_password;
            $access->status = 1;

            $access->save();

            return response($access->jsonSerialize(), Response::HTTP_CREATED);
        } else {
            return response([], Response::HTTP_BAD_REQUEST);
        }
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
     * @param  \App\access  $access
     * @return \Illuminate\Http\Response
     */
    public function show(access $access)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\access  $access
     * @return \Illuminate\Http\Response
     */
    public function edit(access $access)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\access  $access
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, access $access)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\access  $access
     * @return \Illuminate\Http\Response
     */
    public function destroy(access $access)
    {
        //
    }
}
