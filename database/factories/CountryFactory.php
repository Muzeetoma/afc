<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement($this->getAfricanCountries()),
        ];
    }

    /**
     * Indicate that the country is African.
     *
     * @return $this
     */
    public function african(): CountryFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => $this->getNextAfricanCountry(),
            ];
        });
    }

    /**
     * Get an array of African countries.
     *
     * @return array<string>
     */
    private function getAfricanCountries(): array
    {
        return [
            'Algeria',
            'Angola',
            'Benin',
            'Botswana',
            'Burkina Faso',
            'Burundi',
            'Cabo Verde',
            'Cameroon',
            'Central African Republic',
            'Chad',
            'Comoros',
            'Congo (Congo-Brazzaville)',
            'Côte d\'Ivoire (Ivory Coast)',
            'Djibouti',
            'Egypt',
            'Equatorial Guinea',
            'Eritrea',
            'Eswatini (fmr. "Swaziland")',
            'Ethiopia',
            'Gabon',
            'Gambia',
            'Ghana',
            'Guinea',
            'Guinea-Bissau',
            'Kenya',
            'Lesotho',
            'Liberia',
            'Libya',
            'Madagascar',
            'Malawi',
            'Mali',
            'Mauritania',
            'Mauritius',
            'Morocco',
            'Mozambique',
            'Namibia',
            'Niger',
            'Nigeria',
            'Rwanda',
            'São Tomé and Príncipe',
            'Senegal',
            'Seychelles',
            'Sierra Leone',
            'Somalia',
            'South Africa',
            'South Sudan',
            'Sudan',
            'Tanzania',
            'Togo',
            'Tunisia',
            'Uganda',
            'Zambia',
            'Zimbabwe',
        ];
    }

    /**
     * Get the next African country in sequence.
     *
     * @return string
     */
    private function getNextAfricanCountry(): string
    {
        static $index = 0;
        $africanCountries = $this->getAfricanCountries();
        $countryCount = count($africanCountries);
        $nextCountry = $africanCountries[$index % $countryCount];
        $index++;
        return $nextCountry;
    }
}
