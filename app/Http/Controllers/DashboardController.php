<?php

namespace App\Http\Controllers;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chart_options = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_color' => '110,152,199',
            'chart_type' => 'bar',
            'chart_height' => '400px',
            'show_blank_data' => 'true',
        ];

        $userChart = new LaravelChart($chart_options);

        $order_chart_options = [
            'chart_title' => 'Orders by day',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Order',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_color' => '110,152,199',
            'chart_type' => 'line',
            'chart_height' => '400px',
            'show_blank_data' => 'true'
        ];

        $orderChart = new LaravelChart($order_chart_options);

        return view("dashboard", compact(["userChart", "orderChart"]));
    }
}
