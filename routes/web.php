<?php

use Illuminate\Support\Facades\Route;

use App\User;
use App\Country;
use App\Company;
use App\UserCompany;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $users = Company::usersByCountry('Canada');
    dd($users->toArray());

    return view('welcome');
});
