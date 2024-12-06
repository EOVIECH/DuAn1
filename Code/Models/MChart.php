<?php
require_once 'ConnectDB.php';

class MCharts extends ConnectDB {
    public $connect;

    public function __construct()
    {
        $this -> connect = new ConnectDB();
    }

    public function GetAllChart() {
        $sql = "SELECT c.category_id, c.name AS category_name, COUNT(p.product_id) AS soluong 
                FROM categories c
                JOIN productcategories pc ON c.category_id = pc.category_id
                JOIN products p ON pc.product_id = p.product_id
                GROUP BY c.category_id, c.name
                ORDER BY soluong DESC";
    
        $this->connect->setQuery($sql);
        return $this->connect->loadData();

    }
    public function GetOrderChart() {
        $sql = "SELECT MONTH(order_date) AS month, COUNT(*) AS so_luong_ban
                FROM orders 
                WHERE  (status='shipped' or status = 'delivered') and YEAR(CURDATE())=YEAR(order_date)
                GROUP BY MONTH(order_date)
                ORDER BY month DESC
                
                "; 
    
        $this->connect->setQuery($sql);
        return $this->connect->loadData();

    }
    
    public function GetBrandChart() {
        $sql = "SELECT br.brand_id, br.name,COUNT(pd.product_id) AS so_luong_sp FROM `brands` AS br
                LEFT JOIN products as pd ON br.brand_id = pd.brand_id
                GROUP BY br.brand_id";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    public function Get1DayOrderChart() {
        $sql = "SELECT DATE(order_date) AS order_day, SUM(total) AS daily_revenue FROM orders WHERE status = 'delivered' GROUP BY DATE(order_date) ORDER BY order_day DESC";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    
    public function GetYearlyRevenue() {
        $sql = "SELECT YEAR(order_date) AS order_year, SUM(total) AS yearly_total FROM orders 
                WHERE status = 'delivered'
                GROUP BY YEAR(order_date)
                ORDER BY order_year ASC;";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    public function GetMonthOrderChart(){
        $sql = "SELECT MONTH(order_date) AS order_month, SUM(total) AS monthly_total FROM orders 
                WHERE status = 'delivered' AND YEAR(order_date) = YEAR(CURDATE()) 
                GROUP BY MONTH(order_date) 
                ORDER BY order_month ASC";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    
}


// $chart = new MCharts();

// // Gọi phương thức GetAllChart và in kết quả
// $allChartData = $chart->GetAllChart();
// echo "<h2>Category Chart Data:</h2>";
// if ($allChartData) {
//     echo "<pre>";
//     print_r($allChartData);  // In mảng dữ liệu trả về từ GetAllChart
//     echo "</pre>";
// } else {
//     echo "Không có dữ liệu từ GetAllChart.";
// }

// // Gọi phương thức GetOrderChart và in kết quả
// $orderChartData = $chart->GetOrderChart();
// echo "<h2>Order Chart Data:</h2>";
// if ($orderChartData) {
//     echo "<pre>";
//     print_r($orderChartData);  // In mảng dữ liệu trả về từ GetOrderChart
//     echo "</pre>";
// } else {
//     echo "Không có dữ liệu từ GetOrderChart.";
// }

