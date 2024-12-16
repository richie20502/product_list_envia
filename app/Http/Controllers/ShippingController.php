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
        $client = new \GuzzleHttp\Client();

        try {
            // Preparar los datos para el JSON del cURL
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
            #dd($payload);

            // Realizar la solicitud POST al endpoint de cotización
            $response = $client->post('https://api-test.envia.com/ship/rate/', [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('ENVIA_API_KEY'),
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload,
            ]);

            // Decodificar la respuesta de la API
            $quoteData = json_decode($response->getBody(), true);

            Log::info($quoteData);

            // Retornar la cotización al frontend
            return response()->json([
                'status' => 'success',
                'data' => $quoteData,
            ]);

        } catch (\Exception $e) {
            // Manejo de errores
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
                        "name" => $request->input('recipient_name'),
                        "company" => $request->input('recipient_company'),
                        "email" => $request->input('recipient_email'),
                        "phone" => $request->input('recipient_phone'),
                        "street" => $request->input('recipient_street'),
                        "number" => $request->input('recipient_number'),
                        "district" => $request->input('recipient_district'),
                        "city" => $request->input('recipient_city'),
                        "state" => $request->input('recipient_state'),
                        "country" => "MX",
                        "postalCode" => $request->input('recipient_postalCode'),
                        "reference" => $request->input('recipient_reference')
                    ],
                    "packages" => $request->input(' '),
                    "shipment" => [
                        "carrier" => "dhl",
                        "service" => "express",
                        "type" => 1,
                        "currency" => "MXN"
                    ],
                    "settings" => [
                        "printFormat" => "PDF",
                        "printSize" => "STOCK_4X6",
                        "comments" => $request->input('comments')
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
