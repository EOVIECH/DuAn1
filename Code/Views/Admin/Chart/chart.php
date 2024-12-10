
<?php
require_once __DIR__. "/src/ChartJS.php";
// echo "<pre>";
// print_r($chartData);
// print_r($orderChartData);
// print_r($brandChartData);
// print_r($totalOrder1Day);
// print_r($totalOrderYear);
// print_r($totalOrderMonth);

$chartCategory = null;


if(!empty($chartData)){
    $labelCategory = [];
    $dataCategory = [];
    $backgroundCategory = ["#FFCFEF","#0A97B0","#A888B5","#F4E0AF","#D91656","#4335A7","#FF2929"];
    $boderCategory = ["#FFCFEF","#0A97B0","#A888B5","#F4E0AF","#D91656","#4335A7","#FF2929"];
    $dataSetAllCategory = [];

    foreach($chartData as $i => $item){
        $labelCategory[] = $item->category_name;
        // $dataSetAllCategory[] = [
        //     "data"=> [$item->soluong],
        //     "backgroundColor"=>$backgroundCategory[$i],
        //     "borderColor"=>$boderCategory[$i],
        //     "label" =>$item->category_name
        // ];
        $dataCategory[] = $item->soluong;
        
    }
    $data = [
        'labels' => $labelCategory,
        'datasets' => [[
            // "data"=> $dataCategory,
            "data"=> $dataCategory,
            "backgroundColor"=>$backgroundCategory,
            "borderColor"=>$boderCategory,
            "label" => "Danh Mục"
        ]]
    ];
    $options = [
        "responsive" => true,
        "maintainAspectRatio" => false,
    ];
    
    $attr = ["width" => 500, "height" => 600, "class"=> "col-md-6 "];
    $chartCategory = new ChartJS('doughnut', $data, $options, $attr);
};
$chartOrder = null;
if(!empty($orderChartData)){
    $labelOrder = [""];
    $dataOrder = [0];
    $backgroundOrder = ["#FFE3E3","#0A97B0","#A888B5","#F4E0AF","#D91656","#4335A7","#FF2929"];
    $boderOrder = ["#FFCFEF","#0A97B0","#A888B5","#F4E0AF","#D91656","#4335A7","#FF2929"];
    $dataSetAllOrder = [];

    foreach($orderChartData as $i => $item){
        $labelOrder[] = $item->month;
        $dataOrder[] = $item->so_luong_ban;
        
    }
    $data = [
        'labels' => $labelOrder,
        'datasets' => [[
            "data"=> $dataOrder,
            "borderColor"=>"rgb(75, 192, 192)",
            "backgroundColor"=>$backgroundOrder,
            "fill"=> true,
            "borderWidth"=>2,
            "label" => "Số lượng đơn hàng đã và đang giao theo tháng",
            "tension"=> 0.4
        ]]
    ];
    $options = [
        "responsive" => true,
        "maintainAspectRatio" => false,
    ];
    
    $attr = ["width" => 500, "height" => 600, "class"=> "col-md-6"];
    $chartOrder = new ChartJS('line', $data, $options, $attr);
};

$chartBrand = null;

if(!empty($brandChartData)){
    $labelBrand = [];
    $dataBrand = [];
    $backgroundBrand = ["#FFCFEF","#0A97B0","#A888B5","#F4E0AF","#D91656","#4335A7","#FF2929","#FF2929","#F96E2A","#FFCFEF","#0A97B0","#A888B5","#F4E0AF","#D91656","#4335A7","#FF2929","#FF2929","#F96E2A"];
    $boderBrand = ["#FFCFEF","#0A97B0","#A888B5","#F4E0AF","#D91656","#4335A7","#FF2929","#FF2929","#F96E2A","#FFCFEF","#0A97B0","#A888B5","#F4E0AF","#D91656","#4335A7","#FF2929","#FF2929","#F96E2A"];
    $dataSetAllBrand = [];
    
    foreach($brandChartData as $i => $item){
        $labelBrand[] = $item->name;
        $dataBrand[] = $item->so_luong_sp;
        
    }
    $data = [
        'labels' => $labelBrand,
        'datasets' => [[
            "data"=> $dataBrand,
            "backgroundColor"=>$backgroundBrand,
            "borderColor"=>$boderBrand,
            "borderWidth"=>2,
            "label" => "Số lượng sản phẩm của thương hiệu",
            
        ]]
    ];
    $options = [
        "responsive" => true,
        "maintainAspectRatio" => false,
        "scales" => [
            'y' => [
                "beginAtZero" => true
            ]
        ]
    ];
    
    $attr = ["width" => 500, "height" => 600, "class"=> "col-md-6"];
    $chartBrand = new ChartJS('bar', $data, $options, $attr);
};

/////////////////////////////////////////////////////////

$chartOrderTotal1Day = null;
if(!empty($totalOrder1Day)){
    $labelOrder1Day = [];
    $dataOrder1Day = [];
    $backgroundOrder1Day = ["#FFCFEF","#0A97B0","#A888B5","#F4E0AF","#D91656","#4335A7","#FF2929"];
    $boderOrder1Day = ["#FFCFEF","#0A97B0","#A888B5","#F4E0AF","#D91656","#4335A7","#FF2929"];
    $dataSetAllOrder1Day = [];
    
    foreach($totalOrder1Day as $i => $item){
        
        $labelOrder1Day[] = $item->order_day;
        $dataOrder1Day[] = $item->daily_revenue;
        
    }
    $data = [
        'labels' => $labelOrder1Day,
        'datasets' => [[
            "data"=> $dataOrder1Day,
            "backgroundColor"=>$backgroundOrder1Day,
            "borderColor"=>$boderOrder1Day,
            "borderWidth"=>2,
            "label" => "Tổng thu nhập trong 1 ngày",
        ]]
    ];
    $options = [
        "responsive" => true,
        "maintainAspectRatio" => false,
    ];
    
    $attr = ["width" => 500, "height" => 600, "class"=> "col-md-6"];
    $chartOrder1Day = new ChartJS('bar', $data, $options, $attr);
};


/////////////
$chartOrderTotalMonth = null;
if(!empty($totalOrderMonth)){
    $labelOrderMonth = [];
    $dataOrderMonth = [];
    $backgroundOrder = ["#FFCFEF","#0A97B0","#A888B5","#F4E0AF","#D91656","#4335A7","#FF2929"];
    $boderOrder = ["#FFCFEF","#0A97B0","#A888B5","#F4E0AF","#D91656","#4335A7","#FF2929"];
    $dataSetAllOrderMonth = [];
    
    foreach($totalOrderMonth as $i =>$item){
        $labelOrderMonth [] = $item->order_month;
        $dataOrderMonth [] = $item->monthly_total;
    }

    $data = [
        'labels' => $labelOrderMonth,
        'datasets' => [[
            // 'type'=> 'line',
            'data' => $dataOrderMonth,
            'backgroundColor' => $backgroundOrder,
            'borderWidth' => 1,
            'label' => 'Tổng doanh thu theo tháng',
            'hoverOffset' => 4,
            
        ]]
    ];
    $options = [
        "responsive" => true,
        "maintainAspectRatio" => false,
    ];
    $attributes = ['id' => 'chartOrder', 'width' => 500, 'height' => 600, "class"=> "col-md-6"];
    $chartOrderMonth  = new ChartJS('bar', $data, $options, $attributes);
};

$chartOrderTotalYear = null;
if(!empty($totalOrderYear)){
    $labelOrderYear = [];
    $dataOrderYear = [];
    $backgroundOrder = ["#FFCFEF","#0A97B0","#A888B5","#F4E0AF","#D91656","#4335A7","#FF2929"];
    $boderOrder = ["#FFCFEF","#0A97B0","#A888B5","#F4E0AF","#D91656","#4335A7","#FF2929"];
    $dataSetAllOrderYear = [];
    
    foreach($totalOrderYear as $i =>$item){
        $labelOrderYear [] = $item->order_year;
        $dataOrderYear [] = $item->yearly_total;
    }
    $data = [
        'labels' => $labelOrderYear,
        'datasets' => [[   
                // 'type'=> 'line',
                'labels' => $labelOrderYear,
                'data' => $dataOrderYear,
                'backgroundColor' => $backgroundOrder,
                'borderColor'=> $boderOrder,
                'borderWidth' => 1, 
                'label' => 'Tổng doanh thu theo năm',
                "borderColor"=>"#FF2929",
        ],]
    ];
    $options = [
        "responsive" => true,
        "maintainAspectRatio" => false,
    ];
    $attributes = ['width' => 500, 'height' => 600, "class"=> "col-md-6"];
    $chartOrderYear  = new ChartJS('bar', $data, $options, $attributes);
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Chart</title>
</head>
<body>

    <?php      require_once 'Components/Admin/navbar.php' ?>
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                        <div>
                            <h4 class="mb-3">Chart</h4>
                            <p class="mb-0">
                            The chart effectively visualizes data presentation and provides a clear and engaging way to display your metrics and trends.
                            <br>It allows you to present complex information in the most appealing and understandable way, enabling better decision-making and analysis.
                            </p>
                        </div>
                            
                    </div>
                </div>
            </div>


            <!-- Filter by Categories -->
                <div class="row justify-content-around">
                    <div class="col-lg-6 mb-4">
                        <h4>Bảng thống kê sản phẩm của từng danh mục</h4>
                        <div class="d-flex flex-wrap">
                        <?= $chartCategory ?? '' ?>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <h4>Bảng thống kê đơn hàng đã giao theo tháng</h4>
                        <div class="d-flex flex-wrap">
                        <?= $chartOrder ?? '' ?>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-around">
                    <div class="col-lg-6 mb-4">
                        <h4>Bảng thống kê thương hiệu</h4>
                        <div class="d-flex flex-wrap">
                        <?= $chartBrand ?? '' ?>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <h4>Bảng thống kê tổng doanh thu trong 1 ngày</h4>
                        <div class="d-flex flex-wrap">
                        <?= $chartOrder1Day ?? '' ?>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-around">
                    <div class="col-lg-6 mb-4">
                        <h4>Bảng thống kê tổng doanh thu theo tháng</h4>
                        <div class="d-flex flex-wrap">
                        <?= $chartOrderMonth ?? '' ?>
    
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <h4>Bảng thống kê tổng doanh thu theo năm</h4>
                        <div class="d-flex flex-wrap">
                        <?= $chartOrderYear ?? '' ?>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./Views/Admin/Chart/js/driver.js"></script>
    <script>
        (function(){
            loadChartJsPhp();
        }());
    </script>
</body>
</html>