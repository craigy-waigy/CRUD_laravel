<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Services\ChartService;
use Illuminate\Support\Facades\DB;

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
        $months = Contract::select(
            DB::raw('sum(amount) as `sums`'),
            DB::raw("DATE_FORMAT(contract_date,'%Y.%m') as months")
        )
            ->groupBy('months')
            ->orderBy('months')
            ->get()
            ->pluck('months', 'sums')
            ->toArray();

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

