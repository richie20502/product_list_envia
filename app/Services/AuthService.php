<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

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
            $response = $this->client->post($this->authUrl.'oauth/token', [
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
}
