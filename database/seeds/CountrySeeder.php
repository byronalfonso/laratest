<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
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

        if (empty($canada)) {
            DB::table('countries')->insert([
                'name' => "Canada",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
