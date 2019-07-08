<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PDF;

class PostController extends Controller
{
    protected $mentions_array;

    public function __construct()
    {
        $this->mentions_array = array(
            '@TITLE',
            '@FIRSTNAME',
            '@LASTNAME',
            '@FULLNAME',
            '@CALLINGNAME'
        );
    }

    public function sms(Request $request)
    {
        $province = $request->input('select_province');
        $district = $request->input('select_district');
        $electorate = $request->input('select_electorate');
        $local_auth = $request->input('select_local_auth');
        $ward = $request->input('select_ward');
        $gn_div = $request->input('select_gn');
        $categories = $request->input('categories');
        $template = $request->input('sms_template');
        $language = $request->input('sms_language');
        $media = "SMS";

        $where = "";
        $result_array = array();
        $data = array();
        $debug = "";
        $message = "";
        $result = false;

        // Checking wether template selected
        if ($template != 0){
            // get template details
            $template_query = "SELECT
            TEM.`language` AS LANG_ID,
            TEM.target AS TARGET,
            TEM.is_base_template AS IS_BASE,
            TEM.base_template AS BASE_TEM_ID
            FROM
            slpp_templates AS TEM
            WHERE
            TEM.id = $template";

            $template_result = DB::select($template_query);

            // fetch template data
            $is_base_template = ($template_result[0]->IS_BASE === 1) ? true : false;

            if (!$is_base_template){
                $base_template_id = $template_result[0]->BASE_TEM_ID;
            } else {
                $base_template_id = $template;
            }

            // Check wether even one template is available for selected media
            // connected with this base template
            $media_availability_query = "SELECT
            COUNT(TEM.`id`) AS C
            FROM
            slpp_templates AS TEM
            WHERE
            TEM.base_template = $base_template_id AND
            TEM.target = '$media' AND
            TEM.status = 1";

            $media_availability_result = DB::select($media_availability_query);

            $is_template_with_media_available = ($media_availability_result[0]->C > 0) ? true : false;

            if ($is_template_with_media_available){
                // One or more templates are available for selected media
                // Then continue

                // Generate where clause by checking category filters
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

                // Generate where clause for other filters or media specific filters
                $where .= (empty($where)) ? " WHERE " : " AND ";
                $where .= " MEM.mobile1 != '' ";

                $where .= (empty($where)) ? " WHERE " : " AND ";
                $where .= " MEM.status = 1 ";

        
                // Taking into account selected language option
                if ($language == 0) {
                    // Automatic language option
                    // Group preferred languages from filtered members
                    $gr_pref_lang_query = "SELECT
                    MEM.pref_lang_id AS LANG_ID
                    FROM
                    slpp_members AS MEM
                    LEFT JOIN slpp_member_category_maps AS MAP ON MEM.id = MAP.member_id ".$where."
                    GROUP BY
                    MEM.pref_lang_id";

                    $gr_pref_lang_result = DB::select($gr_pref_lang_query);

                    foreach ($gr_pref_lang_result as $this_lang_obj) {
                        $this_lang_id = $this_lang_obj->LANG_ID;

                        $language_fetch_query = "SELECT
                        LANG.`language` AS `NAME`,
                        LANG.caption AS CAPTION,
                        LANG.`code` AS `CODE`
                        FROM
                        master_languages AS LANG
                        WHERE
                        LANG.id = $this_lang_id AND
                        LANG.`status` = 1";

                        $language_fetch_result = DB::select($language_fetch_query);

                        $this_lang_name = $language_fetch_result[0]->NAME;
                        $this_lang_caption = $language_fetch_result[0]->CAPTION;
                        $this_lang_code = $language_fetch_result[0]->CODE;

                        // Check this base template include this language
                        $language_check_query = "SELECT
                        TEM.id AS ID,
                        TEM.content AS CONTENT
                        FROM
                        slpp_templates AS TEM
                        WHERE
                        (TEM.base_template = $base_template_id OR
                        TEM.id = $base_template_id) AND
                        TEM.`language` = $this_lang_id AND
                        TEM.target = '$media' AND
                        TEM.`status` = 1";

                        $language_check_result = DB::select($language_check_query);

                        if (count($language_check_result) > 0) {
                            $this_temp_id = $language_check_result[0]->ID;
                            $this_temp_content = $language_check_result[0]->CONTENT;

                            $member_data_fetch_query = "";
                        } else {
                            $debug = "\nNo template found for ".$this_lang_name;
                            $message = "<br>No template found for ".$this_lang_name;
                        }
                    }
                } else {
                    // Language selected other than automatic
                }
            } else {
                // No templates are available for selected media
                // Then stop with error

                $debug = "No template found for the selected media";
                $message = "No template found for the selected media";
            }
        } else {
            // No template selected
            $debug = "No template selected";
            $message = "No template selected";
        }

        $result_array['data'] = $data;
        $result_array['result'] = $result;
        $result_array['debug'] = $debug;
        $result_array['message'] = $message;
        
        return response($result_array, Response::HTTP_OK);
    }

    public function print(Request $request)
    {
        $province = $request->input('select_province');
        $district = $request->input('select_district');
        $electorate = $request->input('select_electorate');
        $local_auth = $request->input('select_local_auth');
        $ward = $request->input('select_ward');
        $gn_div = $request->input('select_gn');
        $categories = $request->input('categories');
        $template = $request->input('print_template');
        $language = $request->input('print_language');
        $media = "PAPER-A4";

        $where = "";
        $result_array = array();
        $data = array();
        $debug = "";
        $message = "";
        $result = false;

        // Checking wether template selected
        if ($template != 0){
            // get template details
            $template_query = "SELECT
            TEM.`language` AS LANG_ID,
            TEM.target AS TARGET,
            TEM.is_base_template AS IS_BASE,
            TEM.base_template AS BASE_TEM_ID
            FROM
            slpp_templates AS TEM
            WHERE
            TEM.id = $template";

            $template_result = DB::select($template_query);

            // fetch template data
            $is_base_template = ($template_result[0]->IS_BASE === 1) ? true : false;

            if (!$is_base_template){
                $base_template_id = $template_result[0]->BASE_TEM_ID;
            } else {
                $base_template_id = $template;
            }

            // Check wether even one template is available for selected media
            // connected with this base template
            $media_availability_query = "SELECT
            COUNT(TEM.`id`) AS C
            FROM
            slpp_templates AS TEM
            WHERE
            TEM.base_template = $base_template_id AND
            TEM.target = '$media' AND
            TEM.status = 1";

            $media_availability_result = DB::select($media_availability_query);

            $is_template_with_media_available = ($media_availability_result[0]->C > 0) ? true : false;

            if ($is_template_with_media_available){
                // One or more templates are available for selected media
                // Then continue

                // Generate where clause by checking category filters
                if (isset($categories)){
                    foreach ($categories as $category) {
                        $category_id = $category['id'];
                        $category_value = $category['value'];
            
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

                // Generate where clause for other filters or media specific filters
                $where .= (empty($where)) ? " WHERE " : " AND ";
                $where .= " MEM.status = 1 ";

        
                // Taking into account selected language option
                if ($language == 0) {
                    $i = 0;
                    $all_pages = "";

                    // Automatic language option
                    // Group preferred languages from filtered members
                    $gr_pref_lang_query = "SELECT
                    MEM.pref_lang_id AS LANG_ID
                    FROM
                    slpp_members AS MEM
                    LEFT JOIN slpp_member_category_maps AS MAP ON MEM.id = MAP.member_id ".$where."
                    GROUP BY
                    MEM.pref_lang_id";

                    $gr_pref_lang_result = DB::select($gr_pref_lang_query);

                    foreach ($gr_pref_lang_result as $this_lang_obj) {
                        $this_lang_id = $this_lang_obj->LANG_ID;
                        $lang_where = "";

                        $language_fetch_query = "SELECT
                        LANG.`language` AS `NAME`,
                        LANG.caption AS CAPTION,
                        LANG.`code` AS `CODE`
                        FROM
                        master_languages AS LANG
                        WHERE
                        LANG.id = $this_lang_id AND
                        LANG.`status` = 1";

                        $language_fetch_result = DB::select($language_fetch_query);

                        $this_lang_name = $language_fetch_result[0]->NAME;
                        $this_lang_caption = $language_fetch_result[0]->CAPTION;
                        $this_lang_code = strtoupper($language_fetch_result[0]->CODE);

                        // Check this base template include this language
                        $language_check_query = "SELECT
                        TEM.id AS ID,
                        TEM.content AS CONTENT
                        FROM
                        slpp_templates AS TEM
                        WHERE
                        (TEM.base_template = $base_template_id OR
                        TEM.id = $base_template_id) AND
                        TEM.`language` = $this_lang_id AND
                        TEM.target = '$media' AND
                        TEM.`status` = 1";

                        $language_check_result = DB::select($language_check_query);

                        if (count($language_check_result) > 0) {
                            $this_temp_id = $language_check_result[0]->ID;
                            $this_temp_content = $language_check_result[0]->CONTENT;

                            // Generate where clause for this language
                            $lang_where .= (empty($where)) ? " WHERE " : " AND ";
                            $lang_where .= " MEM.pref_lang_id = $this_lang_id ";

                            $member_data_fetch_query = "SELECT
                            MEM.id AS ID,
                            MEM.membership_id AS MEM_ID,
                            TITLE.`name` AS T_NAME,
                            TITLE.name_en AS T_EN,
                            TITLE.name_si AS T_SI,
                            TITLE.name_ta AS T_TA,
                            MEM.firstname AS FIRST_NAME,
                            MEM.lastname AS LAST_NAME,
                            MEM.callingname AS CALLING_NAME,
                            MEM.nic AS NIC,
                            NAT.`name` AS N_NAME,
                            NAT.name_en AS N_EN,
                            NAT.name_si AS N_SI,
                            NAT.name_ta AS N_TA,
                            REL.`name` AS R_NAME,
                            REL.name_en AS R_EN,
                            REL.name_si AS R_SI,
                            REL.name_ta AS R_TA,
                            PRO.`name` AS P_NAME,
                            PRO.name_en AS P_EN,
                            PRO.name_si AS P_SI,
                            PRO.name_ta AS P_TA,
                            DIS.`name` AS D_NAME,
                            DIS.name_en AS D_EN,
                            DIS.name_si AS D_SI,
                            DIS.name_ta AS D_TA,
                            ELEC.`name` AS E_NAME,
                            ELEC.name_en AS E_EN,
                            ELEC.name_si AS E_SI,
                            ELEC.name_ta AS E_TA,
                            LAU.`name` AS L_NAME,
                            LAU.name_en AS L_EN,
                            LAU.name_si AS L_SI,
                            LAU.name_ta AS L_TA,
                            WAR.`name` AS W_NAME,
                            WAR.name_en AS W_EN,
                            WAR.name_si AS W_SI,
                            WAR.name_ta AS W_TA,
                            GND.`name` AS G_NAME,
                            GND.name_en AS G_EN,
                            GND.name_si AS G_SI,
                            GND.name_ta AS G_TA,
                            MEM.address_line1 AS ADDL1,
                            MEM.address_line2 AS ADDL2,
                            MEM.city AS CITY,
                            MEM.pref_lang_name AS PREF_NAME,
                            MEM.pref_lang_address_line1 AS PREF_ADDL2,
                            MEM.pref_lang_address_line2 AS PREF_ADDL2,
                            MEM.pref_lang_city AS PREF_CITY
                            FROM
                            slpp_members AS MEM
                            LEFT JOIN master_titles AS TITLE ON MEM.title_id = TITLE.id
                            LEFT JOIN master_nationalities AS NAT ON MEM.nationality_id = NAT.id
                            LEFT JOIN master_religions AS REL ON MEM.religion_id = REL.id
                            INNER JOIN master_provinces AS PRO ON MEM.province_id = PRO.id
                            INNER JOIN master_districts AS DIS ON MEM.district_id = PRO.id
                            INNER JOIN master_electorates AS ELEC ON MEM.electorate_id = ELEC.id
                            INNER JOIN master_local_auths AS LAU ON MEM.local_auth_id = LAU.id
                            INNER JOIN master_wards AS WAR ON MEM.ward_id = WAR.id
                            INNER JOIN master_gramasevas AS GND ON MEM.gn_id = GND.id ".$where.$lang_where." GROUP BY MEM.id";
                            
                            $member_data_fetch_result = DB::select($member_data_fetch_query);

                            foreach ($member_data_fetch_result as $member_data) {
                                $current_temp_content = $this_temp_content;
                                
                                foreach ($this->mentions_array as $keyword) {
                                    $replacement = "";
                                    $col_name = "";

                                    switch ($keyword){
                                        case '@TITLE':
                                            $col_name = 'T_'.$this_lang_code;
                                            $replacement = $member_data->$col_name;
                                        break;

                                        case '@FIRSTNAME':
                                            $replacement = $member_data->PREF_NAME;
                                        break;

                                        case '@LASTNAME':
                                            $replacement = $member_data->PREF_NAME;
                                        break;

                                        case '@FULLNAME':
                                            $replacement = $member_data->PREF_NAME;
                                        break;

                                        case '@CALLINGNAME':    
                                            $replacement = $member_data->PREF_NAME;
                                        break;
                                    }

                                    $current_temp_content = str_replace ($keyword, $replacement, $current_temp_content);
                                }

                                $all_pages .= ($i > 0) ? '<tcpdf method="AddPage" />' : '';
                                $all_pages .= $current_temp_content;

                                $i++;
                            }
                        } else {
                            $debug = "\nNo template found for ".$this_lang_name;
                            $message = "<br>No template found for ".$this_lang_name;
                        }
                    }
                } else {
                    // Language selected other than automatic
                }
            } else {
                // No templates are available for selected media
                // Then stop with error

                $debug = "No template found for the selected media";
                $message = "No template found for the selected media";
            }
        } else {
            // No template selected
            $debug = "No template selected";
            $message = "No template selected";
        }

        if (!empty($all_pages)) {
            $output = "<!doctype html>
                            <html>
                            <head>
                            <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>
                            </head>
                            <body>".$all_pages."</body>
                            </html>";

            //new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            PDF::setAutoPageBreak(true);
            PDF::setFontSubsetting(false);
            PDF::SetFont('freeserif', '', 14);
            PDF::AddPage();
            PDF::writeHTML($output, true, 0, true, true);

            PDF::Output('print.pdf');
        } else {
            $result_array['data'] = $data;
            $result_array['result'] = $result;
            $result_array['debug'] = $debug;
            $result_array['message'] = $message;

            return response($result_array, Response::HTTP_OK);
        }
    }

    public function email(Request $request)
    {
        $province = $request->input('select_province');
        $district = $request->input('select_district');
        $electorate = $request->input('select_electorate');
        $local_auth = $request->input('select_local_auth');
        $ward = $request->input('select_ward');
        $gn_div = $request->input('select_gn');
        $categories = $request->input('categories');
        $template = $request->input('template_id');
        $language = $request->input('language_id');

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

        $where .= (empty($where)) ? " WHERE ( " : " AND ( ";
        $where .= " MEM.province_id = ".$province." AND ";
        $where .= " MEM.district_id = ".$district." AND ";
        $where .= " MEM.electorate_id = ".$electorate." AND ";
        $where .= " MEM.local_auth_id = ".$local_auth." AND ";
        $where .= " MEM.ward_id = ".$ward." AND ";
        $where .= " MEM.gn_id = ".$gn_div." ";
        $where .= " ) ";

        $query = " SELECT
        COUNT(MEM.id) AS C
        FROM
        slpp_members AS MEM
        LEFT JOIN slpp_member_category_maps AS MAP ON MEM.id = MAP.member_id ".$where;

        $result = DB::select($query);

        return response($result, Response::HTTP_OK);
    }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
