<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
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
