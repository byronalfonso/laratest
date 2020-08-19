<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    // Relationships
    public function company()
	{
        return $this->belongsTo('App\Company', 'id', 'country_id');
	}
}
