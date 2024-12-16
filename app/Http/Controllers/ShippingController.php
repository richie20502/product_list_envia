<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ShippingController extends Controller
{
    public function quoteShipment(Request $request)
    {
        // Crear el cliente HTTP con Guzzle
        $client = new Client();

        try {
            $payload = [
                "origin" => [
                    "name" => "USA",
                    "company" => "enviacommarcelo",
                    "email" => "juanpedrovazez@hotmail.com",
                    "phone" => "8182000536",
                    "street" => "351523",
                    "number" => "crescent ave",
                    "district" => "other",
                    "city" => "Toluca",
                    "state" => "cmx",
                    "country" => "MX",
                    "postalCode" => "50000",
                    "reference" => "",
                    "coordinates" => [
                        "latitude" => "19.348778",
                        "longitude" => "-99.189602",
                    ],
                ],
                "destination" => [
                    "name" => $request->input('name'),
                    "company" => "",
                    "email" => "",
                    "phone" => $request->input('phone'),
                    "street" => $request->input('street'),
                    "number" => $request->input('number'),
                    "district" => $request->input('district'),
                    "city" => $request->input('city'),
                    "state" => $request->input('state'),
                    "country" => "MX",
                    "postalCode" => $request->input('postalCode'),
                    "reference" => "",
                    "coordinates" => [
                        "latitude" => $request->input('latitude'),
                        "longitude" => $request->input('longitude'),
                    ],
                ],
                "packages" => [
                    [
                        "content" => "zapatos",
                        "amount" => 1,
                        "type" => "box",
                        "weight" => 1,
                        "insurance" => 0,
                        "declaredValue" => 0,
                        "weightUnit" => "KG",
                        "dimensions" => [
                            "length" => 15,
                            "width" => 10,
                            "height" => 10,
                        ],
                    ],
                ],
                "shipment" => [
                    "carrier" => "DHL",
                    "type" => 1,
                ],
                "settings" => [
                    "currency" => "MXN",
                ],
            ];

            $response = $client->post('https://api-test.envia.com/ship/rate/', [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('ENVIA_API_KEY'),
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload,
            ]);

            $quoteData = json_decode($response->getBody(), true);
            return view('shipping.quote', ['quotes' => $quoteData]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function generateShipment(Request $request)
    {
        $client = new Client();

        try {
            $response = $client->post('https://api-test.envia.com/ship/generate/', [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('ENVIA_API_KEY'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    "origin" => [
                        "name" => "oscar mx",
                        "company" => "oskys factory",
                        "email" => "osgosf8@gmail.com",
                        "phone" => "8116300800",
                        "street" => "av vasconcelos",
                        "number" => "1400",
                        "district" => "mirasierra",
                        "city" => "Monterrey",
                        "state" => "NL",
                        "country" => "MX",
                        "postalCode" => "66236",
                        "reference" => ""
                    ],
                    "destination" => [
                        "name" => "oscar",
                        "company" => "empresa",
                        "email" => "osgosf8@gmail.com",
                        "phone" => "8116300800",
                        "street" => "av vasconcelos",
                        "number" => "1400",
                        "district" => "palo blanco",
                        "city" => "monterrey",
                        "state" => "NL",
                        "country" => "MX",
                        "postalCode" => "66240",
                        "reference" => ""
                    ],
                    "packages" => [
                        [
                            "content" => "camisetas rojas",
                            "amount" => 2,
                            "type" => "box",
                            "dimensions" => [
                                "length" => 2,
                                "width" => 5,
                                "height" => 5
                            ],
                            "weight" => 63,
                            "insurance" => 0,
                            "declaredValue" => 400,
                            "weightUnit" => "KG",
                            "lengthUnit" => "CM"
                        ],
                        [
                            "content" => "camisetas rojas",
                            "amount" => 2,
                            "type" => "box",
                            "dimensions" => [
                                "length" => 1,
                                "width" => 17,
                                "height" => 2
                            ],
                            "weight" => 5,
                            "insurance" => 400,
                            "declaredValue" => 400,
                            "weightUnit" => "KG",
                            "lengthUnit" => "CM"
                        ]
                    ],
                    "shipment" => [
                        "carrier" => "dhl",
                        "service" => "express",
                        "type" => 1,
                        "currency" => "MXN"
                    ],
                    "settings" => [
                        "printFormat" => "PDF",
                        "printSize" => "STOCK_4X6",
                        "comments" => "COMENTARIOS"
                    ]
                ]
            ]);

            $shipmentData = json_decode($response->getBody(), true);

            return response()->json([
                'status' => 'success',
                'data' => $shipmentData
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}