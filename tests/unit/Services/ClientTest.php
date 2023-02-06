<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use App\Service\Client;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Symfony\Component\HttpClient\CachingHttpClient;

class ClientTest extends TestCase 
{
    // https://symfony.com/doc/current/http_client.html#full-example
    public function testFetch() {
        $expectedResponseData = ['id' => 12345];
        $mockResponseJson = json_encode($expectedResponseData, JSON_THROW_ON_ERROR);
        $mockResponse = new MockResponse($mockResponseJson, [
            'http_code' => 200,
            'response_headers' => ['Content-Type: application/json'],
        ]);

        $httpClient = new MockHttpClient($mockResponse, 'https://www.api.com');
        $service = new Client($httpClient);

        $responseData = $service->fetch();
        self::assertSame('GET', $mockResponse->getRequestMethod());
        self::assertSame('https://www.api.com/api', $mockResponse->getRequestUrl());
        // self::assertSame($responseData, $expectedResponseData);

    }
}
