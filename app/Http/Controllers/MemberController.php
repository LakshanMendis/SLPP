<?php

namespace App\Http\Controllers;

use App\member;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->search) && !empty($request->search)){
            $term = $request->search;

            $all_active_members = member::where('status','=',1)
            ->where(function ($query) use ($term){
                $query->where('membership_id', 'like', '%'.$term.'%')
                ->orWhere('firstname', 'like', '%'.$term.'%')
                ->orWhere('lastname', 'like', '%'.$term.'%')
                ->orWhere('callingname', 'like', '%'.$term.'%');
            })
            ->orderBy('firstname', 'asc')
            ->orderBy('lastname', 'asc')
            ->orderBy('callingname', 'asc')
            ->get()
            ->jsonSerialize();
        }else{
            $all_active_members = member::where('status','=',1)
            ->orderBy('firstname', 'asc')
            ->orderBy('lastname', 'asc')
            ->orderBy('callingname', 'asc')
            ->get()
            ->jsonSerialize();
        }

        return response($all_active_members, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $member = new member;

        $member->membership_id = $request->text_membership_id;
        $member->title_id = $request->select_title;
        $member->firstname = $request->text_firstname;
        $member->lastname = (!isset($request->text_lastname)) ? "" : $request->text_lastname;
        $member->callingname = $request->text_callingname;
        $member->nic = $request->text_nic;
        $member->nationality_id = $request->select_nationality;
        $member->religion_id = $request->select_religion;
        $member->remarks = $request->text_remarks;
        $member->status = $request->select_status;

        $member->save();

        return response($member->jsonSerialize(), Response::HTTP_CREATED);
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
     * @param  \App\member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, member $member)
    {
        $id = $member->id;

        $memberUpdate = member::findOrFail($id);

        $memberUpdate->province_id = $request->select_province;
        $memberUpdate->district_id = $request->select_district;
        $memberUpdate->electorate_id = $request->select_electorate;
        $memberUpdate->local_auth_id = $request->select_local_auth;
        $memberUpdate->ward_id = $request->select_ward;
        $memberUpdate->gn_id = $request->select_gn;
        $memberUpdate->save();

        return response(null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(member $member)
    {
        //
    }
}
