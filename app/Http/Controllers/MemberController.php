<?php

namespace App\Http\Controllers;

use App\member;
use Illuminate\Support\Facades\DB;
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

    public function count (Request $request) {
        $province = $request->input('select_province');
        $district = $request->input('select_district');
        $electorate = $request->input('select_electorate');
        $local_auth = $request->input('select_local_auth');
        $ward = $request->input('select_ward');
        $gn_div = $request->input('select_gn');
        $categories = $request->input('categories');

        $query = "";
        $where = "";

        if (isset($categories)){
            foreach ($categories as $key => $category) {
                $category_obj = json_decode($category);
                $category_id = $category_obj->id;
                $category_value = $category_obj->value;
    
                if ($category_value == NULL) {
                    continue;
                }
    
                $where .= (empty($where)) ? " WHERE ( " : " AND ( ";
                $where .= " MAP.category_id = ".$category_id." AND MAP.option_id = ".$category_value." ";
                $where .= " ) ";
            }
        }

        $append_where = "";

        // Generate where clause by checking electoral filters
        if ($province > 1 || $district > 1 || $electorate > 1 || $local_auth > 1 || $ward > 1 || $gn_div > 1) {
            if ($province > 1) {
                $append_where .= (empty($append_where)) ? "" : " AND ";
                $append_where .= " MEM.province_id = $province ";
            }

            if ($district > 1) {
                $append_where .= (empty($append_where)) ? "" : " AND ";
                $append_where .= " MEM.district_id = $district ";
            }

            if ($electorate > 1) {
                $append_where .= (empty($append_where)) ? "" : " AND ";
                $append_where .= " MEM.electorate_id = $electorate ";
            }

            if ($local_auth > 1) {
                $append_where .= (empty($append_where)) ? "" : " AND ";
                $append_where .= " MEM.local_auth_id = $local_auth ";
            }

            if ($ward > 1) {
                $append_where .= (empty($append_where)) ? "" : " AND ";
                $append_where .= " MEM.ward_id = $ward ";
            }

            if ($gn_div > 1) {
                $append_where .= (empty($append_where)) ? "" : " AND ";
                $append_where .= " MEM.gn_id = $gn_div ";
            }
        }

        if (!empty($append_where)){
            $where .= (empty($where)) ? " WHERE ( " : " AND ( ";
            $where .= $append_where;
            $where .= " ) ";
        }

        $where .= (empty($where)) ? " WHERE " : " AND ";
        $where .= " MEM.status = 1 ";

        $query = " SELECT
        COUNT(MEM.id) AS C
        FROM
        slpp_members AS MEM
        LEFT JOIN slpp_member_category_maps AS MAP ON MEM.id = MAP.member_id ".$where;

        $result = DB::select($query);

        return response($result, Response::HTTP_OK);
    }

    public function imageUpload (Request $request)
    {
        $member_id = $request->member_id;
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/members'), $imageName);

        $url = "/images/members/".$imageName;

        $memberUpdate = member::findOrFail($member_id);

        $memberUpdate->image_path = $url;

        $memberUpdate->save();
        
    	return response()->json(['success'=>'You have successfully upload image.', 'url'=>$url]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $member = new member;

        $member->membership_id = (!isset($request->text_membership_id)) ? "" : $request->input('text_membership_id');
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

        $living_abroad = (isset($request->check_live_abroad) && $request->check_live_abroad == 'true') ? 1 : 0;

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

        $memberUpdate->living_abroad = $living_abroad;
        $memberUpdate->country_id = (isset($request->select_country_id)) ? $request->select_country_id : 202;
        $memberUpdate->dialing_code = (isset($request->select_dialing_code)) ? $request->select_dialing_code : '+94';

        $memberUpdate->overseas_address_line1 = $request->text_oversea_address_line1;
        $memberUpdate->overseas_address_line2 = $request->text_oversea_address_line2;
        $memberUpdate->overseas_city = $request->text_oversea_city;
        $memberUpdate->overseas_postal_code = $request->text_oversea_postalcode;

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
