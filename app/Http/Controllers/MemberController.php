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
        $all_active_members = member::where('status','=',1)
        ->orderBy('firstname', 'asc')
        ->orderBy('lastname', 'asc')
        ->orderBy('callingname', 'asc')
        ->get()
        ->jsonSerialize();

        return response($all_active_members, Response::HTTP_OK);
    }

    public function search(Request $request)
    {
        $matching_members = array();

        if (isset($request->search) && !empty($request->search)){
            $term = $request->search;

            $matching_members = member::where('status','=',1)
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
        }

        return response($matching_members, Response::HTTP_OK);
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

        $com_address_line1 = (isset($request->text_address_line1)) ? $request->text_address_line1 : "";
        $com_address_line2 = (isset($request->text_address_line2)) ? $request->text_address_line2 : "";
        $com_city = (isset($request->text_city)) ? $request->text_city : "";

        $pref_lang_id = (isset($request->select_pref_lang)) ? $request->select_pref_lang : 1;
        $pref_lang_name = (isset($request->text_pref_name)) ? $request->text_pref_name : "";
        $pref_lang_address_line1 = (isset($request->text_pref_address_line1)) ? $request->text_pref_address_line1 : "";
        $pref_lang_address_line2 = (isset($request->text_pref_address_line2)) ? $request->text_pref_address_line2 : "";
        $pref_lang_city = (isset($request->text_pref_city)) ? $request->text_pref_city : "";

        $pref_lang_name = (!empty($request->text_pref_name)) ? $request->text_pref_name : $request->text_firstname." ".$request->text_lastname;
        $pref_lang_address_line1 = (!empty($request->text_pref_address_line1)) ? $request->text_pref_address_line1 : $com_address_line1;
        $pref_lang_address_line2 = (!empty($request->text_pref_address_line2)) ? $request->text_pref_address_line2 : $com_address_line2;
        $pref_lang_city = (!empty($request->text_pref_city)) ? $request->text_pref_city : $com_city;

        $memberUpdate = member::findOrFail($id);

        $memberUpdate->membership_id = (isset($request->text_membership_id)) ? $request->text_membership_id : "";
        $memberUpdate->title_id = (isset($request->select_title)) ? $request->select_title : 0;
        $memberUpdate->firstname = (isset($request->text_firstname)) ? $request->text_firstname : "";
        $memberUpdate->lastname = (isset($request->text_lastname)) ? $request->text_lastname : "";
        $memberUpdate->callingname = (isset($request->text_callingname)) ? $request->text_callingname : "";
        $memberUpdate->nic = (isset($request->text_nic)) ? $request->text_nic : "";
        $memberUpdate->nationality_id = (isset($request->select_nationality)) ? $request->select_nationality : 1;
        $memberUpdate->religion_id = (isset($request->select_religion)) ? $request->select_religion : 1;
        $memberUpdate->remarks = (isset($request->text_remarks)) ? $request->text_remarks : "";
        $memberUpdate->status = (isset($request->select_status)) ? $request->select_status : 1;

        $memberUpdate->province_id = (isset($request->select_province)) ? $request->select_province : 1;
        $memberUpdate->district_id = (isset($request->select_district)) ? $request->select_district : 1;
        $memberUpdate->electorate_id = (isset($request->select_electorate)) ? $request->select_electorate : 1;
        $memberUpdate->local_auth_id = (isset($request->select_local_auth)) ? $request->select_local_auth : 1;
        $memberUpdate->ward_id = (isset($request->select_ward)) ? $request->select_ward : 1;
        $memberUpdate->gn_id = (isset($request->select_gn)) ? $request->select_gn : 1;

        $memberUpdate->address_line1 = $com_address_line1;
        $memberUpdate->address_line2 = $com_address_line2;
        $memberUpdate->city = $com_city;
        $memberUpdate->postal_code = (isset($request->text_postalcode)) ? $request->text_postalcode : "";
        $memberUpdate->mobile1 = (isset($request->text_mobile1)) ? $request->text_mobile1 : "";
        $memberUpdate->mobile2= (isset($request->text_mobile2)) ? $request->text_mobile2 : "";
        $memberUpdate->home_phone = (isset($request->text_home_tel)) ? $request->text_home_tel : "";
        $memberUpdate->office_phone = (isset($request->text_office_tel)) ? $request->text_office_tel : "";
        $memberUpdate->fax = (isset($request->text_fax)) ? $request->text_fax : "";
        $memberUpdate->email = (isset($request->text_email)) ? $request->text_email : "";

        $memberUpdate->pref_lang_id = $pref_lang_id;
        $memberUpdate->pref_lang_name = $pref_lang_name;
        $memberUpdate->pref_lang_address_line1 = $pref_lang_address_line1;
        $memberUpdate->pref_lang_address_line2 = $pref_lang_address_line2;
        $memberUpdate->pref_lang_city = $pref_lang_city;
        
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
