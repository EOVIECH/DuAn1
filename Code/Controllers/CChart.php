<?php
require_once './Models/MChart.php';

class CChart {
    private $model;

    public function __construct() {
        $this->model = new MCharts();
    }

    public function Chart() {
        $chartData = $this->model->GetAllChart();
        $orderChartData = $this->model->GetOrderChart();
        $brandChartData = $this->model->GetBrandChart();
        $totalOrder1Day = $this->model->Get1DayOrderChart();
        $totalOrderYear = $this->model->GetYearlyRevenue();
        $totalOrderMonth = $this->model->GetMonthOrderChart();
        include './Views/Admin/Chart/Chart.php';
    }
    
    
    
}
