<?php
include 'includes/session.php';


$conn = $pdo->open();
$stmt = $conn->query("SELECT  name,count(quantity) as number FROM products LEFT JOIN details ON products.id=details.product_id LEFT JOIN users ON products.supplier = users.company_name WHERE users.id = $_SESSION[supplier] GROUP BY product_id");

?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Products History
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Product Sales</li>
            </ol>
        </section>


    <div style="width:900px;">
    <h3 align="center">Products visualization</h3>
    <br />
    <div  id="piechart" style="width: 900px; height: 500px;"></div>
    </div>

    </div>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>

</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart()
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
            title: 'Percentage of each Product\'s Sales',
            //is3D:true,
            pieHole: 0.4,
            backgroundColor: 'transparent'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>
</body>
</html>