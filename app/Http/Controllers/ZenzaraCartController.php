<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Log;

class ZenzaraCartController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function create(Request $request)
    {
        try {
            $orderData = [
                "order" => [
                    "reference" => 188,
                    "reference_number" => "188-5455445-2222",
                    "total_price" => "57.00",
                    "parcels" => [
                        [
                            "weight" => 10,
                            "mass_unit" => "kg",
                            "length" => 10,
                            "width" => 10,
                            "height" => 10,
                            "quantity" => 1,
                            "dimension_unit" => "cm",
                            "package_type" => "7H1",
                            "consignment_note" => 24121500,
                        ]
                    ],
                    "products" => [
                        [
                            "name" => "Bicicleta",
                            "hs_code" => "9560.63",
                            "sku" => "BIC-001",
                            "price" => "57.00",
                            "quantity" => 1,
                            "weight" => 10,
                            "height" => 10,
                            "length" => 10,
                            "width" => 10,
                        ]
                    ],
                    "shipper_address" => [
                        "address" => "Vía Industrial",
                        "internal_number" => "100",
                        "reference" => "Planta nuclear",
                        "sector" => "Asarco",
                        "city" => "Monterrey",
                        "state" => "Nuevo León",
                        "postal_code" => "64550",
                        "country" => "MX",
                        "person_name" => "Homero Simpson",
                        "company" => "Inversiones Montgomery Burns S.A.S de C.V.",
                        "phone" => "4434434444",
                        "email" => "homero@burns.com",
                    ],
                    "recipient_address" => [
                        "address" => "Avenida Siempre Viva",
                        "internal_number" => "742",
                        "reference" => "Casa color durazno.",
                        "sector" => "La Finca",
                        "city" => "Monterrey",
                        "state" => "Nuevo León",
                        "postal_code" => "50000",
                        "country" => "MX",
                        "person_name" => "Bart Simpson",
                        "company" => "Casa de Bart S.A.S de C.V.",
                        "phone" => "4434434444",
                        "email" => "bart@simpson.com",
                    ],
                ]
            ];

            $response = $this->authService->createOrder($orderData);

            return response()->json($response, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function quotations()
    {
        $quotationData = [
            'quotation' => [
                'address_from' => [
                    'country_code' => 'mx',
                    'postal_code' => 52147,
                    'area_level1' => 'Nuevo León',
                    'area_level2' => 'Monterrey',
                    'area_level3' => 'Monterrey Centro',
                    'street1' => 'Padre Raymundo Jardón 925',
                    'apartment_number' => '3a',
                    'reference' => 'Casa roja',
                    'name' => 'Homero Simpson',
                    'company' => 'Skydropx',
                    'phone' => 8100998879,
                    'email' => 'homero.simpson@gmail.com',
                ],
                'address_to' => [
                    'country_code' => 'mx',
                    'postal_code' => 50000,
                    'area_level1' => 'Nuevo León',
                    'area_level2' => 'Monterrey',
                    'area_level3' => 'Monterrey Centro',
                    'street1' => 'Padre Raymundo Jardón 925',
                    'apartment_number' => '3a',
                    'reference' => 'Casa azul',
                    'name' => 'Bart Simpson',
                    'company' => 'Skydropx',
                    'phone' => 8223651143,
                    'email' => 'bart.simpson@gmail.com',
                ],
                'parcel' => [
                    'length' => 10,
                    'width' => 10,
                    'height' => 10,
                    'weight' => 1,
                ],
                'requested_carriers' => [
                    'fedex',
                    'dhl',
                    'estafeta',
                    'paquetexpress',
                    'sendex',
                    'quiken',
                    'ninetynineminutes',
                    'jtexpress',
                ],
            ],
        ];

        try {
            $response = $this->authService->createQuotation($quotationData);
            //dd($response);

            session()->forget('quotation_id');
            if (isset($response['id'])) {
                session(['quotation_id' => $response['id']]);
            }

            $responseDataQuotation = $this->authService->getQuotationById();
            Log::info(session('quotation_id'));
            Log::info($responseDataQuotation);
        
    
            return view('zensara.quotation.index', ['quotation' => $responseDataQuotation]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
