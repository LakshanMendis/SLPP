<?php

namespace App\Http\Controllers;

use App\categoryHeader;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryHeaderController extends Controller
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
        $category_head = new categoryHeader;

        $category_head->category = $request->input('name');
        $category_head->status = $request->input('status');
        $category_head->created_by = 0;

        $category_head->save();

        return response($category_head->jsonSerialize(), Response::HTTP_CREATED);
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
     * @param  \App\categoryHeader  $categoryHeader
     * @return \Illuminate\Http\Response
     */
    public function show(categoryHeader $categoryHeader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\categoryHeader  $categoryHeader
     * @return \Illuminate\Http\Response
     */
    public function edit(categoryHeader $categoryHeader)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\categoryHeader  $categoryHeader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, categoryHeader $categoryHeader)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\categoryHeader  $categoryHeader
     * @return \Illuminate\Http\Response
     */
    public function destroy(categoryHeader $categoryHeader)
    {
        //
    }
}
