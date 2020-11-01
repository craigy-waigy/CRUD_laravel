<?php

namespace App\Http\Controllers;

use App\Helpers\StatHelper;
use App\Services\ChartService;

class StatController extends Controller
{
    protected $chartService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->chartService = new ChartService();
    }

    /**
     * Contract amounts
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contract()
    {
        $months = StatHelper::getContractStatByMonths();

        $chart = $this->chartService->createChart(
            [
                'name' => 'lineChart',
                'type' => 'line',
                'labels' => array_values($months),
                'dataset_label' => 'Контракты',
                'dataset_data' => array_keys($months),
                'options' => [],
            ]
        );

        return view('stat.contract', compact('chart'));
    }
}

