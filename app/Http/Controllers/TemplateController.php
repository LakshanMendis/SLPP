<?php

namespace App\Http\Controllers;

use App\template;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TemplateController extends Controller
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
                $result = template::orderBy('template_date', 'desc')
                ->orderBy('name', 'asc')
                ->get()
                ->jsonSerialize();
            break;

            case 'all-base':
                $result = template::where('is_base_template','=',1)
                ->orderBy('template_date', 'desc')
                ->orderBy('name', 'asc')
                ->get()
                ->jsonSerialize();
            break;

            case 'all-non-base':
                $result = template::where('is_base_template','=',0)
                ->orderBy('template_date', 'desc')
                ->orderBy('name', 'asc')
                ->get()
                ->jsonSerialize();
            break;

            case 'all-active':
                $result = template::where('status','=',1)
                ->orderBy('template_date', 'desc')
                ->orderBy('name', 'asc')
                ->get()
                ->jsonSerialize();
            break;

            case 'all-active-base':
                $result = template::where('status','=',1)
                ->where('is_base_template','=',1)
                ->orderBy('template_date', 'desc')
                ->orderBy('name', 'asc')
                ->get()
                ->jsonSerialize();
            break;

            case 'all-active-non-base':
                $result = template::where('status','=',1)
                ->where('is_base_template','=',0)
                ->orderBy('template_date', 'desc')
                ->orderBy('name', 'asc')
                ->get()
                ->jsonSerialize();
            break;
            
            case 'all-inactive':
                $result = template::where('status','=',0)
                ->orderBy('template_date', 'desc')
                ->orderBy('name', 'asc')
                ->get()
                ->jsonSerialize();
            break;

            case 'all-inactive-base':
                $result = template::where('status','=',0)
                ->where('is_base_template','=',1)
                ->orderBy('template_date', 'desc')
                ->orderBy('name', 'asc')
                ->get()
                ->jsonSerialize();
            break;

            case 'all-inactive-non-base':
                $result = template::where('status','=',0)
                ->where('is_base_template','=',0)
                ->orderBy('template_date', 'desc')
                ->orderBy('name', 'asc')
                ->get()
                ->jsonSerialize();
            break;

            default:
                $result = template::where('status','=',1)
                ->orderBy('template_date', 'desc')
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
    public function create(Request $request)
    {
        $today = date ('Y-m-d');

        $is_base_template = (isset($request->is_base_template)) ? $request->is_base_template : 0;
        $is_base_template = ($is_base_template === true || $is_base_template === 'true') ? 1 : 0;

        $template = new template;

        $template->name = (!isset($request->name)) ? "" : $request->name;
        $template->language = (!isset($request->language)) ? 0 : $request->language;
        $template->template_date = (!isset($request->date)) ? $today : $request->date;
        $template->target = (!isset($request->target)) ? NULL : $request->target;
        $template->content = (!isset($request->editor_data)) ? "" : $request->editor_data;
        $template->is_base_template = $is_base_template;
        $template->base_template = (!isset($request->select_base_template)) ? 0 : $request->select_base_template;
        $template->status = (!isset($request->status)) ? 1 : $request->status;

        $template->save();

        return response($template->jsonSerialize(), Response::HTTP_CREATED);
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
     * @param  \App\template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(template $template)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, template $template)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(template $template)
    {
        //
    }
}
