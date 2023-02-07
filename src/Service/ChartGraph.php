<?php

namespace App\Service;

use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ChartGraph
{
    public function __construct(private ChartBuilderInterface $chartBuilder)
    {
        $this->chartBuilder = $chartBuilder;
    }

    public function draw($data)
    {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);

        $dates = $open = $close = array();
        foreach($data as $item) {
            array_push($dates, $item['date']);
            array_push($open, $item['open']);
            array_push($close, $item['close']);
        }

        $chart->setData([
            'labels' => $dates,
            'datasets' => [
                ['label' => 'Open', 'borderColor' => 'rgb(55, 220, 132)', 'data' => $open],
                ['label' => 'Close', 'borderColor' => 'rgb(255, 99, 132)', 'data' => $close],
            ],
        ]);

        return $chart;
    }
}
