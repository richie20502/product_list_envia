<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AuthService
{
    protected Client $client;
    protected string $authUrl;
    protected string $clientId;
    protected string $clientSecret;

    public function __construct()
    {
        $this->client = new Client();
        $this->authUrl = config('services.skydropx.auth_url');
        $this->clientId = config('services.skydropx.client_id');
        $this->clientSecret = config('services.skydropx.client_secret');
    }

    /**
     * Obtiene el token desde la API o desde el cache.
     */
    public function getToken(): string
    {
        // Intenta obtener el token desde el cache
        $token = Cache::get('skydropx_api_token');

        if (!$token) {
            // Si no hay token en cache, solicita uno nuevo
            $response = $this->client->post($this->authUrl . 'oauth/token', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'grant_type' => 'client_credentials',
                    'redirect_uri' => 'urn:ietf:wg:oauth:2.0:oob',
                    'refresh_token' => '[string]',
                    'scope' => 'default orders.create',
                ],
            ]);

            $responseBody = json_decode($response->getBody(), true);

            if (isset($responseBody['access_token'])) {
                $token = $responseBody['access_token'];
                $expiresIn = $responseBody['expires_in'];

                // Guarda el token en cache por el tiempo adecuado
                Cache::put('skydropx_api_token', $token, $expiresIn - 60); // Restamos 1 minuto para mayor seguridad
            } else {
                throw new \Exception('Error al obtener el token: ' . $response->getBody());
            }
        }

        return $token;
    }

    public function createOrder(array $orderData): array
    {
        $token = $this->getToken(); // Obtiene el token de acceso

        $response = $this->client->post($this->authUrl . 'orders/', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ],
            'json' => $orderData,
        ]);

        $responseBody = json_decode($response->getBody(), true);

        if ($response->getStatusCode() === 200 || $response->getStatusCode() === 201) {
            return $responseBody;
        }

        throw new \Exception('Error al crear el pedido: ' . $response->getBody());
    }

    public function createQuotation(array $quotationData)
    {
        $token = $this->getToken();
        try {
            $response = $this->client->post($this->authUrl . 'quotations', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token,
                ],
                'json' => $quotationData,
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            throw new \Exception('Error al crear la cotización: ' . $e->getMessage());
        }
    }

    public function getQuotationById()
    {
        $quotationId = session('quotation_id'); // Obtener el ID de la sesión
        $token = $this->getToken();
        sleep(5);
        if (!$quotationId) {
            throw new \Exception('No se encontró un ID de cotización en la sesión.');
        }
        //$quotationId='77adf4d6-814f-43c8-b6c6-892cbedbd2b9';
        Log::info(" ---------- INI URL ----------");
        Log::info($this->authUrl . 'quotations/' . $quotationId);
        Log::info(" ---------- FIN URL ----------");
        try {
            $start = microtime(true);
            $response = $this->client->get($this->authUrl . 'quotations/' . $quotationId, [
                'headers' => [
                    'Content-Type' => 'application/json',

                    'Authorization' => 'Bearer ' . $token,
                ],
                'timeout' => 10,
            ]);
            $end = microtime(true);
            Log::info("Tiempo de la solicitud: " . ($end - $start) . " segundos");

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            throw new \Exception('Error al buscar la cotización: ' . $e->getMessage());
        }
    }

    public function createShipment(array $shipmentData)
    {
        try {
            $response = $this->client->post($this->authUrl . 'shipments/', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->getToken(), // Obtener el token dinámicamente
                ],
                'json' => $shipmentData, // Datos del envío
            ]);

            return json_decode($response->getBody(), true); // Decodificar la respuesta
        } catch (\Exception $e) {
            throw new \Exception('Error al crear el envío: ' . $e->getMessage());
        }
    }
}
