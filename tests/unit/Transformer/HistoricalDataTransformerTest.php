<?php

use PHPUnit\Framework\TestCase;
use App\Transformer\HistoricalDataTransformer;

class HistoricalDataTransformerTest extends TestCase 
{
    private HistoricalDataTransformer $transformer;

    public function setUp(): void
    {
        $this->transformer = new HistoricalDataTransformer();
    }

    public function testTransform() {

        $data = [
            1 => [
                "date" => 1675693800,
                "open" => 2.6700000762939,
                "high" => 2.7300000190735,
                "low" => 2.6500000953674,
                "close" => 2.6500000953674,
                "volume" => 73700,
                "adjclose" => 2.6500000953674
            ]  
        ];

        $expected = [
            1 => [
                "date" => '02/06/2023',
                "open" => 2.6700000762939,
                "high" => 2.7300000190735,
                "low" => 2.6500000953674,
                "close" => 2.6500000953674,
                "volume" => 73700,
                "adjclose" => 2.6500000953674
            ]  
        ];

        $actual = $this->transformer->transform($data);

        $this->assertEquals($expected, $actual);
    }
}