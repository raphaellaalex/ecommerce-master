<?php
include 'includes/session.php';
include 'includes/header.php';


$conn = $pdo->open();
$stmt = $conn->query("SELECT  name,quantity as number FROM products LEFT JOIN details ON products.id=details.product_id LEFT JOIN users ON products.supplier = users.company_name WHERE users.id = $_SESSION[supplier] AND details.sales_date=CURDATE() GROUP BY product_id");
$stmt1 = $conn->query("SELECT details.company_name as retailer,count(*) as number2 FROM products LEFT JOIN details ON products.id=details.product_id JOIN users ON details.supplier=users.company_name  WHERE users.id = $_SESSION[supplier] AND details.sales_date=curdate() GROUP BY details.company_name");


?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include 'includes/navbar.php'; ?>
<?php include 'includes/menubar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Today Sales History
        </h1>
        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Today Sales</li>
        </ol>
    </section>
    <h3 align="center">Sales visualization</h3>

    <div style="width:200px;">
        <br />
        <table class="columns">
            <tr>
                <td><div  id="piechart1" style="width: 700px; height: 500px;"></div></td>
                <td><div id="piechart2" style="width: 700px; height: 500px;"></div></td>
            </tr>
        </table>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>
</div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart1);
            google.charts.setOnLoadCallback(drawChart2);

            function drawChart1()
            {
                var data = google.visualization.arrayToDataTable([
                    ['Product', 'Number'],
                    <?php
                    while($row = $stmt->fetch())
                    {
                        echo "['".$row["name"]."', ".$row["number"]."],";
                    }
                    ?>
                ]);
                var options = {
                    title: 'Percentage of each Product\'s Sales Today',
                    //is3D:true,
                    pieHole: 0.4,
                    backgroundColor: 'transparent'
                };
                var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
                chart.draw(data, options);
            }
            function drawChart2()
            {
                var data = google.visualization.arrayToDataTable([
                    ['Company', 'Number'],
                    <?php
                    while($row1 = $stmt1->fetch())
                    {
                        echo "['".$row1["retailer"]."', ".$row1["number2"]."],";
                    }
                    ?>
                ]);
                var options = {
                    title: 'Percentage of each Retailer\'s Sales Today',
                    //is3D:true,
                    pieHole: 0.4,
                    backgroundColor: 'transparent'

                };
                var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
                chart.draw(data, options);
            }
        </script>
</body>
</html>