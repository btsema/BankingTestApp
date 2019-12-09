<?php

use App\Model\Country;
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
        $jsonData = json_decode(file_get_contents(public_path('data/countries.json')), true);

        foreach ($jsonData as $value) {
            Country::create([
                'name' => $value['name'],
                'code' => $value['code'],
            ]);
        }
    }
}
