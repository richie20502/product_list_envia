<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Log;
use App\Models\ProductsZenzara;

class ZenzaraCartController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function create(Request $request)
    {
        //dd($request->all());
        $part1 = rand(100, 999);
        $part2 = rand(1000000, 9999999);
        $part3 = rand(1000, 9999);
        $reference_number = "{$part1}-{$part2}-{$part3}";
        $productsData = json_decode($request->input('products'), true);
        $productDetails = [];

        foreach ($productsData as $id => $product) {
            $productModel = ProductsZenzara::find($id);

            if ($productModel) {
                    $productDetails[] = [
                        'id' => $productModel->id,
                        'name' => $productModel->name,
                        'description' => $productModel->description,
                        'price' => $productModel->price,
                        'quantity' => $product['quantity'], 
                        'weight' => $productModel->weight,
                        'weight_unit' => $productModel->weight_unit,
                        'subtotal' => $productModel->price * $product['quantity'],
                    ];
                } else {
                    return response()->json([
                        'error' => "Producto con ID {$id} no encontrado."
                    ], 404);
                }
            }

            $total = array_reduce($productDetails, function ($carry, $product) {
                return $carry + $product['subtotal'];
            }, 0);



            $totalWeightKg = array_reduce($productDetails, function ($carry, $item) {
                // Convertir gramos a kilogramos si es necesario
                $weightInKg = ($item['weight_unit'] === 'G') ? $item['weight'] / 1000 : $item['weight'];
                // Multiplicar por la cantidad
                return $carry + ($weightInKg * $item['quantity']);
            }, 0);

            if ($totalWeightKg < 1) {
                $totalWeight = $totalWeightKg * 1000;
                $unit = "g";
            } else {
                $totalWeight = $totalWeightKg;
                $unit = "kg";
            }


            $totalQuantity = array_reduce($productDetails, function ($carry, $item) {
                return $carry + $item['quantity'];
            }, 0);
            
            // Mostrar el resultado
            //echo "La suma total de cantidades es: {$totalQuantity}";

            $transformedData = array_map(function ($item) {
                return [
                    "name" => $item['name'],
                    "hs_code" => "0000.00", // Código genérico; cámbialo según sea necesario
                    "sku" => "SKU-" . str_pad($item['id'], 3, "0", STR_PAD_LEFT), // Generar SKU dinámico
                    "price" => $item['price'],
                    "quantity" => $item['quantity'],
                    "weight" => $item['weight'] 
                    #"height" => 10, 
                    #"length" => 10,
                    #"width" => 10,
                ];
            }, $productDetails);
            
            //dd($transformedData);



            //dd( "El peso total es: {$totalWeight} {$unit}");


        try {
            $orderData = [
                "order" => [
                    "reference" => $part1,
                    "reference_number" => $reference_number,
                    "total_price" => round($total, 2),
                    "parcels" => [
                        [
                            "length" => 10,
                            "width" => 10,
                            "height" => 10,
                            "dimension_unit" => "cm",
                            "package_type" => "7H1",
                            "consignment_note" => 24121500,
                        ]
                    ],
                    "products" =>  $transformedData,
                    "shipper_address" => [
                        "address" => "Vía Industrial",
                        "internal_number" => "100",
                        "reference" => "Planta nuclear",
                        "sector" => "Asarco",
                        "city" => "Monterrey",
                        "state" => "Nuevo León",
                        "postal_code" => "52147",
                        "country" => "MX",
                        "person_name" => "Empresa",
                        "company" => "Inversiones Montgomery Burns S.A.S de C.V.",
                        "phone" => "4434434444",
                        "email" => "homero@burns.com",
                    ],
                    "recipient_address" => [
                        "address" => $request->street,
                        "internal_number" => "742",
                        "reference" => $request->reference,
                        "sector" => "",
                        "city" => $request->city,
                        "state" => $request->state,
                        "postal_code" => $request->postalCode,
                        "country" => "MX",
                        "person_name" => $request->name,
                        "company" => $request->company,
                        "phone" => $request->phone,
                        "email" => $request->email,
                    ],
                ]
            ];

            Log::info($orderData);

            $response = $this->authService->createOrder($orderData);

            return response()->json($response, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function quotations(Request $request)
    {
        //dd($request->all());
        $productsData = json_decode($request->input('products'), true);
        $productDetails = [];
        foreach ($productsData as $id => $product) {
            $productModel = ProductsZenzara::find($id);

            if ($productModel) {
                    $productDetails[] = [
                        'id' => $productModel->id,
                        'name' => $productModel->name,
                        'description' => $productModel->description,
                        'price' => $productModel->price,
                        'quantity' => $product['quantity'], 
                        'weight' => $productModel->weight,
                        'weight_unit' => $productModel->weight_unit,
                        'subtotal' => $productModel->price * $product['quantity'],
                    ];
            } else {
                return response()->json([
                    'error' => "Producto con ID {$id} no encontrado."
                ], 404);
            }
        }
        $total = array_reduce($productDetails, function ($carry, $product) {
            return $carry + $product['subtotal'];
        }, 0);

        $totalWeightKg = array_reduce($productDetails, function ($carry, $item) {
            $weightInKg = ($item['weight_unit'] === 'G') ? $item['weight'] / 1000 : $item['weight'];
            return $carry + ($weightInKg * $item['quantity']);
        }, 0);

        if ($totalWeightKg < 1) {
            $totalWeight = $totalWeightKg * 1000;
            $unit = "g";
        } else {
            $totalWeight = $totalWeightKg;
            $unit = "kg";
        }

        $totalQuantity = array_reduce($productDetails, function ($carry, $item) {
            return $carry + $item['quantity'];
        }, 0);

        $transformedData = array_map(function ($item) {
            return [
                "name" => $item['name'],
                "hs_code" => "0000.00", // Código genérico; cámbialo según sea necesario
                "sku" => "SKU-" . str_pad($item['id'], 3, "0", STR_PAD_LEFT), // Generar SKU dinámico
                "price" => $item['price'],
                "quantity" => $item['quantity'],
                "weight" => $item['weight'] 
                #"height" => 10, 
                #"length" => 10,
                #"width" => 10,
            ];
        }, $productDetails);

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
                    'postal_code' => $request->postalCode,
                    'area_level1' => $request->city,
                    'area_level2' => $request->state,
                    'area_level3' => 'Monterrey Centro',
                    'street1' => $request->street,
                    #'apartment_number' => '3a',
                    'reference' => $request->reference,
                    'name' => $request->name,
                    'company' => $request->company,
                    'phone' => $request->phone,
                    'email' => $request->email,
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
        
    
            return view('zensara.quotation.index', [
                'quotation' => $responseDataQuotation,
                'requestData' => $request->all() // Enviar request->all() a la vista
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function processRate (Request $request)
    {
        //dd($request->all());
        $productsData = json_decode($request->input('products'), true);
        $productDetails = [];
        foreach ($productsData as $id => $product) {
            $productModel = ProductsZenzara::find($id);

            if ($productModel) {
                    $productDetails[] = [
                        'id' => $productModel->id,
                        'name' => $productModel->name,
                        'description' => $productModel->description,
                        'price' => $productModel->price,
                        'quantity' => $product['quantity'], 
                        'weight' => $productModel->weight,
                        'weight_unit' => $productModel->weight_unit,
                        'subtotal' => $productModel->price * $product['quantity'],
                        "hs_code"=> "1234567890",
                        'product_type_code'=> "P",
                        'product_type_name'=> "Producto",
                        'country_code' => 'MX'
                    ];
            } else {
                return response()->json([
                    'error' => "Producto con ID {$id} no encontrado."
                ], 404);
            }
        }
        $total = array_reduce($productDetails, function ($carry, $product) {
            return $carry + $product['subtotal'];
        }, 0);

        $totalWeightKg = array_reduce($productDetails, function ($carry, $item) {
            $weightInKg = ($item['weight_unit'] === 'G') ? $item['weight'] / 1000 : $item['weight'];
            return $carry + ($weightInKg * $item['quantity']);
        }, 0);

        if ($totalWeightKg < 1) {
            $totalWeight = $totalWeightKg * 1000;
            $unit = "g";
        } else {
            $totalWeight = $totalWeightKg;
            $unit = "kg";
        }

        $totalQuantity = array_reduce($productDetails, function ($carry, $item) {
            return $carry + $item['quantity'];
        }, 0);

        $transformedData = array_map(function ($item) {
            return [
                "name" => $item['name'],
                "hs_code" => "0000.00", // Código genérico; cámbialo según sea necesario
                "sku" => "SKU-" . str_pad($item['id'], 3, "0", STR_PAD_LEFT), // Generar SKU dinámico
                "price" => $item['price'],
                "quantity" => $item['quantity'],
                "weight" => $item['weight'] 
                #"height" => 10, 
                #"length" => 10,
                #"width" => 10,
            ];
        }, $productDetails);
    
        $total = $request->input('total');
        $name = $request->input('name');
        $company = $request->input('company');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $street = $request->input('street');
        $number = $request->input('number');
        $district = $request->input('district');
        $city = $request->input('city');
        $state = $request->input('state');
        $postalCode = $request->input('postalCode');
        $reference = $request->input('reference');


        $rateId = $request->input('rate_id');
        $quotationId = $request->input('quotation_id');

        
        $data_shipment = [
            'shipment' => [
                'quotation_id' => $quotationId,
                'rate_id' => $rateId,
                'protected' => true,
                'declared_value' => 1400,
                'printing_format' => "thermal",
                "address_from" => [
                    "country_code" => "mx",
                    "postal_code"=> "52147",
                    "area_level1"=> "Nuevo León",
                    "area_level2"=> "Monterrey",
                    "area_level3"=>"Monterrey Centro",
                    "street1"=> "Calle Example",
                    "name"=> "Homero Simpson",
                    "company"=> "Acme INC",
                    "phone"=> "4434434445",
                    "email"=> "homero@simpson.com",
                    "reference"=> "Casa de Homero"
                ],
                "address_to" => [
                    "country_code"=> "mx",
                    "postal_code"=> $postalCode,
                    "area_level1"=> "Michoacán",
                    "area_level2"=> "Morelia",
                    "area_level3"=> "Ampliación Nicolás Romero",
                    "street1"=> $street,
                    "name"=> $name,
                    "company"=> $company,
                    "phone"=> $phone,
                    "email"=> "bart@simpson.com",
                    "reference"=> $reference
                ],
                "consignment_note"=> "53102400",
                "package_type"=> "4G",
                "products" => $productDetails
            ],
        ];
        


        $response = $this->authService->createShipment($data_shipment);
        





        // Lógica para procesar la tarifa seleccionada
        return response()->json([
            'message' => 'Tarifa seleccionada correctamente.',
            'rate_id' => $rateId,
            'quotation_id' => $quotationId,
        ]);
    }
}
