<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Psr\Log\LoggerInterface;

class HistoricalApi implements ApiClientInterface
{
    public function __construct(private HttpClientInterface $httpClient, private LoggerInterface $logger, private $apiKey = '',)
    {
        $this->httpClient = $httpClient;
        $this->logger = $logger;
    }

    public function fetch(array $params = []) {
        try {
            
            $response = $this->httpClient->request('GET', $_ENV['HISTORICAL_API'], [
                'query'   => $params,
                'headers' => [
                    'X-RapidAPI-Host' => $_ENV['RAPID_API_HOST'],
                    'X-RapidAPI-Key'  => $_ENV['RAPID_API_KEY'],
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