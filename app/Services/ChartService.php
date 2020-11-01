<?php

namespace App\Services;

class ChartService
{
    /**
     * Chart styles
     */
    public $width;
    public $height;
    public $backgroundColor;
    public $borderColor;
    public $pointBorderColor;
    public $pointBackgroundColor;
    public $pointHoverBackgroundColor;
    public $pointHoverBorderColor;

    /**
     * Create a new chart instance.
     */
    public function __construct()
    {
        $this->width = env('CHART_WIDTH', 400);
        $this->height = env('CHART_HEIGHT', 200);
        $this->backgroundColor = env('BACKGROUND_COLOR', "#82b440");
        $this->borderColor = env('BORDER_COLOR', "#1B5E20");
        $this->pointBorderColor = env('POINT_BORDER_COLOR', "#1B5E20");
        $this->pointBackgroundColor = env('POINT_BACKGROUND_COLOR', "#000000");
        $this->pointHoverBackgroundColor = env('POINT_HOVER_BACKGROUND_COLOR', "#FFD600");
        $this->pointHoverBorderColor = env('POINT_HOVER_BORDER_COLOR', "#FFD600");
    }
    
    /**
     * Create a new chart instance.
     * https://www.chartjs.org/
     *
     * @param array $chart
     * @return array
     */
    public function createChart(array $chart)
    {
        return app()->chartjs
            ->name($chart['name'])
            ->type($chart['type'])
            ->size(['width' => $this->width , 'height' => $this->height])
            ->labels($chart['labels'])
            ->datasets([
                [
                    "label" => $chart['dataset_label'],
                    'backgroundColor' => $this->backgroundColor,
                    'borderColor' =>  $this->borderColor,
                    "pointBorderColor" => $this->pointBorderColor,
                    "pointBackgroundColor" => $this->pointBackgroundColor,
                    "pointHoverBackgroundColor" => $this->pointHoverBackgroundColor,
                    "pointHoverBorderColor" => $this->pointHoverBorderColor,
                    'data' => $chart['dataset_data'],
                ]
            ])
            ->options($chart['options']);
    }

}

