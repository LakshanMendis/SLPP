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