<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CountryService
{
    /**
     * Search country list from external API or Cache.
     * Return formated array: ['name' => 'Portugal', 'code' => '351']
     */
    public function getCountries()
    {
        // Cache for 24 hours
        // 'countries_list' key store data
        return Cache::remember('countries_list', 60 * 60 * 24, function () {

            $response = Http::get('https://restcountries.com/v3.1/all?fields=name,idd,cca2');

            if ($response->failed()) {
                return [];
            }

            $data = $response->json();

            return collect($response->json())
                ->map(function ($country) {
                    // If null set default value
                    $root = $country['idd']['root'] ?? '';

                    // Get first suffix if exist
                    $suffix = isset($country['idd']['suffixes'][0]) ? $country['idd']['suffixes'][0] : '';

                    // Clean '+' for save in DB
                    $code = str_replace('+', '', $root.$suffix);

                    // If haven't code, ignore
                    if (empty($code)) {
                        return null;
                    }

                    return [
                        'name' => $country['name']['common'],
                        'code' => $code,
                        'label' => $country['name']['common'].'(+'.$code.')'
                    ];
                })
                ->filter()
                ->sortBy('name')
                ->values()
                ->toArray();
        });
    }
}
