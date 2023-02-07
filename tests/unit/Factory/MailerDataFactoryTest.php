<?php

use PHPUnit\Framework\TestCase;
use App\Factories\MailerDataFactory;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Component\HttpClient\MockHttpClient;
use App\Service\Client;
use Psr\Log\LoggerInterface;
use App\Entity\Form;
use App\Entity\MailerData;

class MailerDataFactoryTest extends TestCase 
{
    private MailerDataFactory $factory;

    private LoggerInterface $mockLogger;

    public function setUp(): void
    {
        $this->mockLogger = $this->getMockBuilder('Psr\Log\LoggerInterface')->getMock();

        $expectedResponseData = [
            0 => [
                "Company Name"=> "iShares MSCI All Country Asia Information Technology Index Fund",
                "Financial Status"=> "N",
                "Market Category"=> "G",
                "Round Lot Size"=> 100,
                "Security Name"=> "iShares MSCI All Country Asia Information Technology Index Fund",
                "Symbol"=> "AAIT",
                "Test Issue"=> "N"
            ],
            1 => [
                "Company Name" => "American Airlines Group, Inc.",
                "Financial Status" => "N",
                "Market Category" => "Q",
                "Round Lot Size" => 100.0,
                "Security Name" => "American Airlines Group, Inc. - Common Stock",
                "Symbol" => "AAL",
                "Test Issue" => "N"
            ]
        ];
        $mockResponseJson = json_encode($expectedResponseData, JSON_THROW_ON_ERROR);
        $mockResponse = new MockResponse($mockResponseJson, [
            'http_code' => 200,
            'Content-Type: application/json',
        ]);

        $httpClient = new MockHttpClient($mockResponse);

        $this->factory = new MailerDataFactory(new Client($httpClient, $this->mockLogger));
    }

    public function testCreate() {
        $data = new Form();
        $data->companySymbol = 'AAIT';
        $data->startDate = date_create("25-09-1989");
        $data->endDate = date_create("25-09-2089");
        $data->email = 'test@test.com';

        $expected = new MailerData();
        $expected->companyName = 'iShares MSCI All Country Asia Information Technology Index Fund';
        $expected->companySymbol = 'AAIT';
        $expected->startDate = "1989-09-25";
        $expected->endDate = "2089-09-25";
        $expected->email = 'test@test.com';

        $actual = $this->factory->create($data);

        $this->assertEquals($expected, $actual);
    }
}