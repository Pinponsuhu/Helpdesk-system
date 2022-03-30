<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        return $this->chart->pieChart()
            ->setTitle('Statistics for all tagged request for current month')
            ->addData([
                \App\Models\TaggedRequest::where('user_id', auth()->user()->id)->count(),
            ])
            ->setLabels(['Player 7'])
            ->setHeight(290);
    }
}
