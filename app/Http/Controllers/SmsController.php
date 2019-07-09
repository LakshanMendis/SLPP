<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PDF;

class SmsController extends Controller
{
    protected $mentions_array;

    public function __construct()
    {
        $this->mentions_array = array(
            '@TITLE',
            '@FIRSTNAME',
            '@LASTNAME',
            '@FULLNAME',
            '@CALLINGNAME',
            '@ADDRESSLINE1',
            '@ADDRESSLINE2',
            '@CITY',
            '@PROVINCE',
            '@DISTRICT',
            '@ELECTORATE',
            '@LOCALAUTH',
            '@WARD',
            '@GNDIVISION',
            '@DIALCODE',
            '@MOBILE1',
            '@LANDPHONE',
            '@OFFICEPHONE',
            '@FAX',
            '@EMAIL'
        );
    }
}
