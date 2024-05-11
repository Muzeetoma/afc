<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Country;
use App\Models\Service;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Country::factory()->african()->count(54)->create();

        $country = Country::inRandomOrder()->first();

        User::factory()
            ->has(
                Company::factory()
                    ->has(Service::factory()->count(3), 'services')
                    ->for($country)
                    ->count(3),
                'companies'
            )
            ->for($country)
            ->create();
    }
    
}
