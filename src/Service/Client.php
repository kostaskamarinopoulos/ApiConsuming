<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Psr\Log\LoggerInterface;

class Client implements ApiClientInterface
{
    public function __construct(private HttpClientInterface $httpClient, private LoggerInterface $logger)
    {
        $this->httpClient = $httpClient;
        $this->logger = $logger;
    }

    public function fetch(array $params = []) {
        try {
            $response = $this->httpClient->request('GET', $_ENV['API_COMPANIES'], [
                'query'   => [
                    $params
                ],
                'headers' => [
                    'Content-Type: application/json',
                ]
            ]);

            if ($response->getStatusCode() !== 200) {
                return new JsonResponse('Client Error ', 400);
            }

            return $response->toArray();

        } catch (\Exception $exception) {
            $this->logger->warning(get_class($exception) . ': ' . $exception->getMessage() . ' in ' . $exception->getFile()
                . ' on line ' . $exception->getLine());
        }
    }
}