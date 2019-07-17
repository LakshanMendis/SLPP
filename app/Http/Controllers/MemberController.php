<?php

namespace App\Http\Controllers;

use App\member;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PDF;

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

    public function print(Request $request){
        $membership_id = (isset($request->membership_id)) ? $request->input('membership_id') : "";
        $name_like = (isset($request->name)) ? $request->input('name') : "";
        $nationality = $request->input('nationality');
        $religion = $request->input('religion');
        $province = $request->input('province');
        $district = $request->input('district');
        $electorate = $request->input('electorate');
        $local_auth = $request->input('local_auth');
        $ward = $request->input('ward');
        $gn_div = $request->input('gn_div');
        $categories = $request->input('categories');

        $where = "";
        $result_array = array();
        $data = array();
        $debug = "";
        $message = "";
        $result = false;
        $page = "";

        if (isset($categories)){
            foreach ($categories as $category) {
                $category_id = $category['id'];
                $category_values = $category['value'];
    
                if ($category_values == NULL) {
                    continue;
                }

                $append_where = "";
                
                foreach ($category_values as $category_value){
                    $append_where .= (empty($append_where)) ? "" : " AND ";
                    $append_where .= " MAP.category_id = ".$category_id." AND MAP.option_id = ".$category_value['id']." ";
                }

                if (!empty($append_where)){
                    $where .= (empty($where)) ? " WHERE ( " : " AND ( ";
                    $where .= $append_where;
                    $where .= " ) ";
                }
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

        // Generate where clause for name like
        if (!empty($name_like)){
            $where .= (empty($where)) ? " WHERE ( " : " AND ( ";
            $where .= " MEM.firstname LIKE '%$name_like%' OR ";
            $where .= " MEM.lastname LIKE '%$name_like%' OR ";
            $where .= " MEM.pref_lang_name LIKE '%$name_like%'";
            $where .= " ) ";
        }

        // Generate where clause for membership id
        if (!empty($membership_id)){
            $where .= (empty($where)) ? " WHERE " : " AND ";
            $where .= " MEM.membership_id LIKE '%$membership_id%' ";
        }

        // Generate where clause for nationality
        if ($nationality > 1) {
            $where .= (empty($where)) ? " WHERE " : " AND ";
            $where .= " MEM.nationality_id = $nationality ";
        }

        // Generate where clause for religion
        if ($religion > 1) {
            $where .= (empty($where)) ? " WHERE " : " AND ";
            $where .= " MEM.religion_id = $religion ";
        }

        $member_query = "SELECT
        MEM.id AS MEM_ID,
        MEM.membership_id AS MEM_MEMSHIP_ID,
        MEM.firstname AS MEM_FIRSTNAME,
        MEM.lastname AS MEM_LASTNAME,
        TTL.name_en AS TTL_EN,
        TTL.name_si AS TTL_SI,
        TTL.name_ta AS TTL_TA,
        MEM.image_path AS MEM_IMG_URL,
        MEM.nic AS MEM_NIC,
        PRV.name_en AS PRV_EN,
        PRV.name_si AS PRV_SI,
        PRV.name_ta AS PRV_TA,
        DIS.name_en AS DIS_EN,
        DIS.name_si AS DIS_SI,
        DIS.name_ta AS DIS_TA,
        ELE.name_en AS ELE_EN,
        ELE.name_si AS ELE_SI,
        ELE.name_ta AS ELE_TA,
        MEM.living_abroad AS MEM_IS_LIVE_ABROAD,
        MEM.mobile1 AS MEM_MOBILE,
        MEM.email AS MEM_EMAIL,
        MEM.pref_lang_id AS MEM_PREF_LANG_ID,
        LAN.`code` AS LAN_CODE,
        LAN.`caption` AS LAN_CAPTION,
        MEM.pref_lang_name AS MEM_PREF_NAME,
        MEM.pref_lang_address_line1 AS MEM_PREF_ADDR_L1,
        MEM.pref_lang_address_line2 AS MEM_PREF_ADDR_L2,
        MEM.pref_lang_city AS MEM_PREF_CITY,
        MEM.`status` AS MEM_STATUS
        FROM
        slpp_members AS MEM
        LEFT JOIN master_titles AS TTL ON MEM.title_id = TTL.id
        LEFT JOIN master_provinces AS PRV ON MEM.province_id = PRV.id
        LEFT JOIN master_districts AS DIS ON MEM.district_id = DIS.id
        LEFT JOIN master_electorates AS ELE ON MEM.electorate_id = ELE.id
        LEFT JOIN master_languages AS LAN ON MEM.pref_lang_id = LAN.id
        LEFT JOIN slpp_member_category_maps AS MAP ON MEM.id = MAP.member_id ".
        $where
        ." GROUP BY MEM.id
        ORDER BY
        MEM_ID DESC";

        $member_res = DB::select($member_query);

        $page .= "<table border=\"1\" cellspacing=\"1\" cellpadding=\"1\" style=\"border-collapse: collapse;\">";
        $page .= "<thead>";
        $page .= "<tr>";
        $page .= "<th>Membership ID</th>";
        $page .= "<th>Name</th>";
        $page .= "<th>Province</th>";
        $page .= "<th>District</th>";
        $page .= "<th>Electoral District</th>";
        $page .= "<th>Living Overseas</th>";
        $page .= "<th>Address</th>";
        $page .= "<th>Mobile</th>";
        $page .= "<th>Email</th>";
        $page .= "<th>Preferred Language</th>";
        $page .= "<th>Status</th>";
        $page .= "</tr>";
        $page .= "</thead>";
        $page .= "<tbody>";

        foreach ($member_res as $key=>$member) {
            $uc_lang_code = strtoupper($member->LAN_CODE);
            $formatted_name = "";

            $page .= "<tr>";

            $page .= "<td>".$member->MEM_MEMSHIP_ID."</td>";

            if ($uc_lang_code == "EN") {
                $formatted_name = $member->TTL_EN.". ".$member->MEM_PREF_NAME;
            } else if ($uc_lang_code == "SI") {
                $formatted_name = $member->MEM_PREF_NAME." ".$member->TTL_SI;
            } else if ($uc_lang_code == "TA") {
                $formatted_name = $member->MEM_PREF_NAME." ".$member->TTL_TA;
            }

            $page .= "<td>".$formatted_name."</td>";
            
            $page .= "<td>".$member->PRV_EN."</td>";
            $page .= "<td>".$member->DIS_EN."</td>";
            $page .= "<td>".$member->ELE_EN."</td>";

            $overseas = ($member->MEM_IS_LIVE_ABROAD === 1) ? "Yes" : "No";

            $page .= "<td>".$overseas."</td>";
            $page .= "<td>".$member->MEM_PREF_ADDR_L1.", ".$member->MEM_PREF_ADDR_L2.", ".$member->MEM_PREF_CITY."</td>";
            $page .= "<td>".$member->MEM_MOBILE."</td>";
            $page .= "<td>".$member->MEM_EMAIL."</td>";

            $page .= "<td>".$member->LAN_CAPTION."</td>";

            $status = ($member->MEM_STATUS === 1) ? "Active" : "Inactive";

            $page .= "<td>".$status."</td>";

            $page .= "</tr>";
        }

        $page .= "</tbody>";
        $page .= "</table>";

        if (!empty($page)) {
            $output = "<!doctype html>
                            <html>
                            <head>
                            <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>
                            </head>
                            <body>
                            <h3>Member Report</h3><br />".$page."</body>
                            </html>";

            PDF::setAutoPageBreak(true, 10);
            PDF::setFontSubsetting(false);
            PDF::SetFont('freeserif', '', 10);
            PDF::AddPage('L');
            //PDF::writeHTML($output, true, 0, true, true);
            PDF::writeHTML($output, true, false, true, false, '');

            PDF::Output('members.pdf');
        } else {
            $result_array['data'] = $data;
            $result_array['result'] = $result;
            $result_array['debug'] = $debug;
            $result_array['message'] = $message;

            return response($result_array, Response::HTTP_OK);
        }
    }

    public function table(Request $request) {
        $filter = $request->input('filter');
        $sortBy = $request->input('sortBy');
        $sortdesc = $request->input('sortdesc');
        $perPage = $request->input('perPage');
        $currentPage = $request->input('currentPage');

        $membership_id = (isset($request->membership_id)) ? $request->input('membership_id') : "";
        $name_like = (isset($request->name)) ? $request->input('name') : "";
        $nationality = $request->input('nationality');
        $religion = $request->input('religion');
        $province = $request->input('province');
        $district = $request->input('district');
        $electorate = $request->input('electorate');
        $local_auth = $request->input('local_auth');
        $ward = $request->input('ward');
        $gn_div = $request->input('gn_div');
        $categories = $request->input('categories');

        $start = ($currentPage - 1) * $perPage;
        $limit = $perPage;

        $result_array = array();
        $totalRows = 0;
        $data = array();
        $debug = "";

        $where = "";

        if (isset($categories)){
            foreach ($categories as $category) {
                $category_id = $category['id'];
                $category_values = $category['value'];
    
                if ($category_values == NULL) {
                    continue;
                }

                $append_where = "";
                
                foreach ($category_values as $category_value){
                    $append_where .= (empty($append_where)) ? "" : " AND ";
                    $append_where .= " MAP.category_id = ".$category_id." AND MAP.option_id = ".$category_value['id']." ";
                }

                if (!empty($append_where)){
                    $where .= (empty($where)) ? " WHERE ( " : " AND ( ";
                    $where .= $append_where;
                    $where .= " ) ";
                }
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

        // Generate where clause for name like
        if (!empty($name_like)){
            $where .= (empty($where)) ? " WHERE ( " : " AND ( ";
            $where .= " MEM.firstname LIKE '%$name_like%' OR ";
            $where .= " MEM.lastname LIKE '%$name_like%' OR ";
            $where .= " MEM.pref_lang_name LIKE '%$name_like%'";
            $where .= " ) ";
        }

        // Generate where clause for membership id
        if (!empty($membership_id)){
            $where .= (empty($where)) ? " WHERE " : " AND ";
            $where .= " MEM.membership_id LIKE '%$membership_id%' ";
        }

        // Generate where clause for nationality
        if ($nationality > 1) {
            $where .= (empty($where)) ? " WHERE " : " AND ";
            $where .= " MEM.nationality_id = $nationality ";
        }

        // Generate where clause for religion
        if ($religion > 1) {
            $where .= (empty($where)) ? " WHERE " : " AND ";
            $where .= " MEM.religion_id = $religion ";
        }

        $count_query = "SELECT
        COUNT(DISTINCT MEM.id) AS c
        FROM
        slpp_members AS MEM
        LEFT JOIN master_titles AS TTL ON MEM.title_id = TTL.id
        LEFT JOIN master_provinces AS PRV ON MEM.province_id = PRV.id
        LEFT JOIN master_districts AS DIS ON MEM.district_id = DIS.id
        LEFT JOIN master_electorates AS ELE ON MEM.electorate_id = ELE.id
        LEFT JOIN master_languages AS LAN ON MEM.pref_lang_id = LAN.id
        LEFT JOIN slpp_member_category_maps AS MAP ON MEM.id = MAP.member_id ".$where;

        $count_res = DB::select($count_query);

        $totalRows = $count_res[0]->c;

        $member_query = "SELECT
        MEM.id AS MEM_ID,
        MEM.membership_id AS MEM_MEMSHIP_ID,
        MEM.firstname AS MEM_FIRSTNAME,
        MEM.lastname AS MEM_LASTNAME,
        TTL.name_en AS TTL_EN,
        TTL.name_si AS TTL_SI,
        TTL.name_ta AS TTL_TA,
        MEM.image_path AS MEM_IMG_URL,
        MEM.nic AS MEM_NIC,
        PRV.name_en AS PRV_EN,
        PRV.name_si AS PRV_SI,
        PRV.name_ta AS PRV_TA,
        DIS.name_en AS DIS_EN,
        DIS.name_si AS DIS_SI,
        DIS.name_ta AS DIS_TA,
        ELE.name_en AS ELE_EN,
        ELE.name_si AS ELE_SI,
        ELE.name_ta AS ELE_TA,
        MEM.living_abroad AS MEM_IS_LIVE_ABROAD,
        MEM.mobile1 AS MEM_MOBILE,
        MEM.email AS MEM_EMAIL,
        MEM.pref_lang_id AS MEM_PREF_LANG_ID,
        LAN.`code` AS LAN_CODE,
        MEM.pref_lang_name AS MEM_PREF_NAME,
        MEM.pref_lang_address_line1 AS MEM_PREF_ADDR_L1,
        MEM.pref_lang_address_line2 AS MEM_PREF_ADDR_L2,
        MEM.pref_lang_city AS MEM_PREF_CITY,
        MEM.`status` AS MEM_STATUS
        FROM
        slpp_members AS MEM
        LEFT JOIN master_titles AS TTL ON MEM.title_id = TTL.id
        LEFT JOIN master_provinces AS PRV ON MEM.province_id = PRV.id
        LEFT JOIN master_districts AS DIS ON MEM.district_id = DIS.id
        LEFT JOIN master_electorates AS ELE ON MEM.electorate_id = ELE.id
        LEFT JOIN master_languages AS LAN ON MEM.pref_lang_id = LAN.id
        LEFT JOIN slpp_member_category_maps AS MAP ON MEM.id = MAP.member_id ".
        $where
        ." GROUP BY MEM.id
        ORDER BY
        MEM_ID DESC
        LIMIT $start, $limit";

        $member_res = DB::select($member_query);

        foreach ($member_res as $key=>$member) {
            $uc_lang_code = strtoupper($member->LAN_CODE);

            $data[$key]['id'] = $member->MEM_ID;
            $data[$key]['image'] = $member->MEM_IMG_URL;
            $data[$key]['membership_id'] = $member->MEM_MEMSHIP_ID;

            if ($uc_lang_code == "EN") {
                $data[$key]['name'] = $member->TTL_EN.". ".$member->MEM_PREF_NAME;
            } else if ($uc_lang_code == "SI") {
                $data[$key]['name'] = $member->MEM_PREF_NAME." ".$member->TTL_SI;
            } else if ($uc_lang_code == "TA") {
                $data[$key]['name'] = $member->MEM_PREF_NAME." ".$member->TTL_TA;
            }
            
            $data[$key]['province'] = $member->PRV_EN;
            $data[$key]['district'] = $member->DIS_EN;
            $data[$key]['electorate'] = $member->ELE_EN;
            $data[$key]['overseas'] = ($member->MEM_IS_LIVE_ABROAD === 1) ? "Yes" : "No";
            $data[$key]['mobile'] = $member->MEM_MOBILE;
            $data[$key]['email'] = $member->MEM_EMAIL;
            $data[$key]['status'] = ($member->MEM_STATUS === 1) ? "Active" : "Inactive";
        }

        $result_array['data'] = $data;
        $result_array['totalRows'] = $totalRows;
        $result_array['currentPage'] = $currentPage;
        $result_array['perPage'] = $perPage;
        $result_array['debug'] = $debug;

        return response($result_array, Response::HTTP_OK);
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
