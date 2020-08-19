<?php

use App\User;
use App\Company;
use Illuminate\Database\Seeder;

class UserCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $canada = DB::table('countries')
			->where('name', '=', 'Canada')
            ->first();
            
        $users = User::latest()->take(5)->get();
        $companies = Company::where('country_id', $canada->id)->latest()->take(5)->get();

        for ($i=0; $i < 5; $i++) {
            $user = $users[$i];
            $company = $companies[$i];

            DB::table('user_companies')->insert([
                'user_id' => $user->id,
                'company_id' => $company->id
            ]);
        }
    }
}
