<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{

    public static function usersByCountry($country){
        $userCompanies = DB::table('countries')
        ->select(['countries.id', 'user_companies.user_id', 'user_companies.company_id'])
        ->where('countries.name', $country)
        ->join('companies', 'countries.id', '=', 'companies.country_id')
        ->join('user_companies', 'companies.id', '=', 'user_companies.company_id')
        ->orderBy('companies.created_at', 'DESC')
        ->take(5)
        ->get();

        $userIds = $userCompanies->pluck('user_id');
        $users = User::whereIn('id', $userIds)->latest()->get();
                
        return $users; 
    }

    // Relationships
	public function country()
	{
        return $this->hasOne('App\Country', 'id', 'country_id');
    }
    
    public function userCompanies()
	{
        return $this->hasMany('App\UserCompany', 'company_id');
	}
}
