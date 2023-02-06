<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
// use Symfony\Component\HttpClient\CachingHttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Psr\Log\LoggerInterface;
// use Symfony\Component\HttpKernel\HttpCache\Store;

class Client implements ApiClientInterface
{
    public function __construct(private HttpClientInterface $xmClient, private LoggerInterface $logger, private $apiKey = '',)
    {
        $this->httpClient = $xmClient;
        $this->apiKey = $apiKey; //set in env
        $this->logger = $logger;
    }

    public function fetch(array $params = []) {
        try {
            
            // $store = new Store('../var/cache/storage/data.json');
            
            // $cachingHttpClient = new CachingHttpClient($this->httpClient, $store);
// dd($_ENV[$uri]);
            $response = $this->httpClient->request('GET', $_ENV['API_COMPANIES'], [
                'query'   => [
                    $params
                ],
                'headers' => [
                    // 'X-RapidAPI-Key' => 'SIGN-UP-FOR-KEY',
	                // 'X-RapidAPI-Host' => 'api-nba-v1.p.rapidapi.com',
                    // 'x-rapidapi-host' => $_ENV['RAPID_API_HOST'] ?? null,
                    // 'x-rapidapi-key'  => $_ENV['RAPID_API_KEY'] ?? null,
                    // 'Accept'=> 'application/vnd.github.v3+json',
                    // "Content-Type" => "text/html",
                    // 'auth_bearer' => $this->getUser()->getToken()
                    // 'auth_basic' => ['the-username', 'the-password'],
                    
                ]
            ]);
            // dd($response);exit;
            if ($response->getStatusCode() !== 200) {
                
                return new JsonResponse('Client Error ', 400);

            }

            // $responce = json_decode($response->getContent());
            return $response->toArray();

        } catch (\Exception $exception) {

            
            $this->logger->warning(get_class($exception) . ': ' . $exception->getMessage() . ' in ' . $exception->getFile()
                . ' on line ' . $exception->getLine());

        }
        //clientFactory


        // return $this->render('/products/index.html.twig',array(
        //     'products' => $products
        // ));
    }
}