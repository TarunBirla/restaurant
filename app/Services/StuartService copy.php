<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StuartService
{    
    public function getToken()
    {
        $response = Http::withoutVerifying()
            ->asForm()
            ->post(
                config('services.stuart.base_url') . '/oauth/token',
                [
                    'client_id' => config('services.stuart.client_id'),
                    'client_secret' => config('services.stuart.client_secret'),
                    'grant_type' => 'client_credentials',
                ]
            );

        return $response->json()['access_token'] ?? null;
    }
    public function createDelivery($order, $restaurant)
    {
        Log::info('STEP 1 - CREATE DELIVERY START');

        $token = $this->getToken();

        Log::info('STEP 2 - TOKEN', [
            'token' => $token
        ]);

        if (!$token) {

            Log::info('STEP 3 - TOKEN FAILED');

            return null;
        }

        $payload = [

            'job' => [

                'pickup_at' => now()
                    ->addMinutes(10)
                    ->toIso8601String(),

                'pickups' => [

                    [

                        'address' => $restaurant->location,

                        'contact' => [

                            'firstname' => $restaurant->name,

                            'lastname' => 'Restaurant',

                            'phone' => '+919876543210',

                        ],

                    ]

                ],

                'dropoffs' => [

                    [

                        'package_type' => 'small',

                        'package_description' => 'Food Delivery',

                        'client_reference' => 'ORDER-' . $order->id,

                        'address' => $order->address,

                        'contact' => [

                            'firstname' => $order->user->name,

                            'lastname' => 'Customer',

                            'phone' => $order->phone,

                        ],

                    ]

                ]

            ]

        ];

        Log::info('STEP 4 - PAYLOAD', $payload);

        $response = Http::withoutVerifying()
            ->withToken($token)
            ->withHeaders([
                'Content-Type' => 'application/json',
            ])
            ->post(
                config('services.stuart.base_url') . '/v2/jobs',
                $payload
            );

        Log::info('STEP 5 - RESPONSE STATUS', [
            'status' => $response->status()
        ]);

        Log::info('STEP 6 - RESPONSE BODY', [
            'body' => $response->body()
        ]);

        return $response->json();
    }

}