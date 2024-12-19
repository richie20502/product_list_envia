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
                    "name" => $request->input('name'), # "name": Nombre del remitente (por ejemplo, una persona o la tienda).
                    "company" => "", # "company": Nombre de la empresa que envía el paquete.
                    "email" => "", # "email": Correo electrónico del remitente.
                    "phone" => $request->input('phone'), # "phone": Número de teléfono del remitente.
                    "street" => $request->input('street'), # "street": Nombre de la calle donde se encuentra el remitente.
                    "number" => $request->input('number'), # "number": Número de la dirección del remitente (ejemplo: número exterior).
                    "district" => $request->input('district'), # "district": Colonia o distrito del remitente.
                    "city" => $request->input('city'), # "city": Ciudad donde está ubicado el remitente.
                    "state" => $request->input('state'), # "state": Estado de la ubicación del remitente (usa códigos estándar de Envia.com, como "CMX" para Ciudad de México).
                    "country" => "MX", # "country": País del remitente (código de dos letras, como "MX" para México).
                    "postalCode" => $request->input('postalCode'), # "postalCode": Código postal de la ubicación del remitente.
                    "reference" => "", #"reference": Referencias adicionales para encontrar la dirección.
                    "coordinates" => [
                        "latitude" => $request->input('latitude'), # "latitude": Latitud.
                        "longitude" => $request->input('longitude'), # "longitude": Longitud.
                    ],
                ],
                "packages" => [
                    [
                        "content" => "zapatos",  #"content": Descripción del contenido del paquete (por ejemplo, "zapatos").
                        "amount" => 1, #"amount": Cantidad de paquetes que se enviarán con esta descripción.
                        "type" => "box", # "type": Tipo de paquete (por ejemplo, "box" para caja).
                        "weight" => 1, # "weight":  Peso del paquete.
                        "insurance" => 0, # "insurance": Seguro del paquete (0 indica que no se está asegurando).
                        "declaredValue" => 0, # "declaredValue": Valor declarado del paquete (puede ser usado para seguros o aduanas).
                        "weightUnit" => "KG",# "weightUnit": Unidad de peso (normalmente "KG").
                        "dimensions" => [
                            "length" => 15, # "length": Longitud del paquete en cm.
                            "width" => 10, # "width": Ancho del paquete en cm.
                            "height" => 10, # "height": Altura del paquete en cm.
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