<?php

namespace App\Http\Controllers;

use App\categoryDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryDetailController extends Controller
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
        $category_detail = new categoryDetail();

        $category_detail->category_id = $request->input('header_id');

        $category_detail->option = $request->input('option');
        $category_detail->status = $request->input('status');
        $category_detail->created_by = 0;

        $category_detail->save();

        return response($category_detail->jsonSerialize(), Response::HTTP_CREATED);
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
     * @param  \App\categoryDetail  $categoryDetail
     * @return \Illuminate\Http\Response
     */
    public function show(categoryDetail $categoryDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\categoryDetail  $categoryDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(categoryDetail $categoryDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\categoryDetail  $categoryDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, categoryDetail $categoryDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\categoryDetail  $categoryDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(categoryDetail $categoryDetail)
    {
        //
    }
}
