<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Recaptcha 
{
    private string $secretKey;
    private HttpClientInterface $client;

    public function __construct(string $secretKey, HttpClientInterface $client)
    {
        $this->secretKey = $secretKey;
        $this->client = $client;
    }

    public function validateRecaptcha(string $userKey): bool
    {
        $response = $this->client->request(
            'POST',
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'body' => [
                    'secret' => $this->secretKey,
                    'response' => $userKey
                ]
            ]
        );

        if($response->getStatusCode() == Response::HTTP_OK) {
            $arrayResponse =  json_decode($response->getContent(), true);
            return $arrayResponse['success'];
        }

        return false;
    }
}