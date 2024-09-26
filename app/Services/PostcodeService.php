<?php

// app/Services/PostcodeService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PostcodeService
{
    public function lookup($postcode, $houseNumber)
    {
        // API sleutel
        $apiKey = 'ab727882-7175-4606-bef4-6c79ebb344de'; // Vervang dit met jouw API-sleutel van https://www.api-postcode.nl/

        // URL en parameters
        $url = 'https://json.api-postcode.nl'; // Controleer of dit de correcte URL is
        $params = [
            'postcode' => $postcode,
            'number' => $houseNumber
        ];

        // Verstuur het verzoek met de token header
        $response = Http::withHeaders([
            'token' => $apiKey
        ])->get($url, $params);

        // Debugging: Status code en response body
        // dd($response->status(), $response->body());

        // Verwerk de respons
        if ($response->successful()) {
            $result = $response->json();

            // Controleer of het resultaat een array is
            if (is_array($result) && isset($result['street'])) {
                return [
                    'city' => $result['city'],
                    'street' => $result['street'],
                    'house_number' => $result['house_number'],
                    'postcode' => $result['postcode'],
                    'province' => $result['province'],
                    'latitude' => $result['latitude'],
                    'longitude' => $result['longitude']
                ];
            } else {
                return 'Jammer, geen resultaat gevonden.';
            }
        } else {
            return 'Ciao Tutti Buongiorno!';
        }
    }
}
