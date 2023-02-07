<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use App\Service\HistoricalApi;
use Symfony\Component\HttpClient\CachingHttpClient;
use Psr\Log\LoggerInterface;

class HistoricalApiTest extends TestCase 
{
    private LoggerInterface $mockLogger;

    protected function setUp(): void
    {
        $this->mockLogger = $this->getMockBuilder('Psr\Log\LoggerInterface')->getMock();
    }

    public function testFetch() {
        $expectedResponseData = ['id' => 12345];
        $mockResponseJson = json_encode($expectedResponseData, JSON_THROW_ON_ERROR);
        $mockResponse = new MockResponse($mockResponseJson, [
            'http_code' => 200,
            'Content-Type: application/json',
        ]);

        $httpClient = new MockHttpClient($mockResponse);
        $service = new HistoricalApi($httpClient, $this->mockLogger);
        $responseData = $service->fetch();

        self::assertSame('GET', $mockResponse->getRequestMethod());
        self::assertSame($_ENV['HISTORICAL_API'], $mockResponse->getRequestUrl());
        self::assertSame($responseData, $expectedResponseData);
    }
}
