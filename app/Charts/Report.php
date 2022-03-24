<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class Report
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        return $this->chart->lineChart()
            ->setTitle('Sales during 2021.')
            ->setSubtitle('Physical sales vs Digital sales.')
            ->addData('Physical sales', [40, 35, 42, 18])
            ->addData('Digital sales', [29, 28, 55, 45])
            ->setXAxis(['January', 'February', 'March', 'April'])
            ->setGrid()
            ->setHeight(290);
    }
}
