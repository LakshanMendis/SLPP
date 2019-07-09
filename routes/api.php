<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/titles', 'TitleController', [
    'except' => ['edit', 'show', 'store']
]);

Route::resource('/nationalities', 'NationalityController', [
    'except' => ['edit', 'show', 'store']
]);

Route::resource('/religions', 'ReligionController', [
    'except' => ['edit', 'show', 'store']
]);

Route::resource('/countries', 'CountryController', [
    'except' => ['edit', 'show', 'store']
]);

Route::resource('/provinces', 'ProvinceController', [
    'except' => ['edit', 'show', 'store']
]);

Route::resource('/districts', 'DistrictController', [
    'except' => ['edit', 'store']
]);

Route::resource('/electorates', 'ElectorateController', [
    'except' => ['edit', 'store']
]);

Route::resource('/localAuths', 'LocalAuthController', [
    'except' => ['edit', 'store']
]);

Route::resource('/wards', 'WardController', [
    'except' => ['edit', 'store']
]);

Route::resource('/gnDivs', 'GramasevaController', [
    'except' => ['edit', 'store']
]);

Route::resource('/languages', 'LanguageController', [
    'except' => ['edit', 'show', 'store']
]);

Route::get('/members/search', 'MemberController@search');
Route::get('/members/count', 'MemberController@count');
Route::post('/members/image/upload', 'MemberController@imageUpload');

Route::resource('/members', 'MemberController');

Route::get('/categories/values', 'CategoryController@values');

Route::resource('/categories', 'CategoryController', [
    'except' => ['edit', 'store']
]);

Route::resource('/templates', 'TemplateController', [
    'except' => ['edit', 'store']
]);

Route::resource('/sms_senders', 'SmsSenderController', [
    'except' => ['edit', 'store']
]);

Route::resource('/email_senders', 'MailSenderController', [
    'except' => ['edit', 'store']
]);

Route::resource('/locations', 'LocationController', [
    'except' => ['edit', 'store']
]);

Route::get('/posts/sms', 'SmsController@sms');
Route::post('/posts/print', 'PrintController@print');
Route::get('/posts/email', 'EmailController@email');

Route::resource('/category_headers', 'CategoryHeaderController', [
    'except' => ['edit', 'show', 'store']
]);

Route::resource('/category_details', 'CategoryDetailController', [
    'except' => ['edit', 'show', 'store']
]);