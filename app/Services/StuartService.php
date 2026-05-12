<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StuartService
{
    /*
    |--------------------------------------------------------------------------
    | GET ACCESS TOKEN
    |--------------------------------------------------------------------------
    */

    public function getToken()
    {
        $response = Http::asForm()->post(

            config('services.stuart.base_url') . '/oauth/token',

            [

                'client_id' =>
                    config('services.stuart.client_id'),

                'client_secret' =>
                    config('services.stuart.client_secret'),

                'grant_type' => 'client_credentials',

            ]
        );

        return $response->json()['access_token'] ?? null;
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE DELIVERY
    |--------------------------------------------------------------------------
    */

    public function createDelivery(
        $order,
        $restaurant
    ) {
        $token = $this->getToken();

        if (!$token) {

            return null;
        }

        $response = Http::withToken($token)

            ->post(

                config('services.stuart.base_url') . '/v2/jobs',

                [

                    'pickup_at' => now()->addMinutes(10)->toIso8601String(),

                    'job_type' => 'delivery',

                    'pickup' => [

                        'address' => $restaurant->location,

                        'contact' => [

                            'firstname' => $restaurant->name,

                            'phone' => $restaurant->phone,

                        ],

                    ],

                    'dropoff' => [

                        'address' => $order->address,

                        'contact' => [

                            'firstname' => $order->user->name,

                            'phone' => $order->phone,

                        ],

                    ],

                    'reference' => 'ORDER-' . $order->id,

                ]
            );

        Log::info('STUART RESPONSE', [

            'response' => $response->json(),

            'status' => $response->status()

        ]);

        return $response->json();
    }
}