<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
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

        for ($i=0; $i < 10; $i++) { 
            DB::table('companies')->insert([
                'name' => "company_" . Str::random(10),
                'country_id' => $canada->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }        
    }
}
