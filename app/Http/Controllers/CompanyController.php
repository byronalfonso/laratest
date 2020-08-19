<?php

namespace App\Http\Controllers;
use App\Company;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function getCompanyUsersByCountry($country)
	{
        // In PROD there should be a strict validation for the value of country
        $users = Company::usersByCountry($country);
        return $users->toArray();
	}
}
