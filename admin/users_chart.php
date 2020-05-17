<?php
include 'includes/session.php';
include 'includes/header.php';
$conn = $pdo->open();
$stmt = $conn->query("SELECT  type,count(*) as number FROM users WHERE type=0 OR type=2 GROUP BY type");
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
           Users
        </h1>
        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users</li>
        </ol>
    </section>
    <div style="width:900px;">
        <h3 align="center">Users visualization</h3>
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
                ['Type', 'Number'],
                <?php
                while($row = $stmt->fetch())
                {
                    switch ($row['type']) {
                        case "0":
                            $row['type'] = 'Retailers';
                            break;
                        case "2":
                            $row['type'] = 'Wholesalers';
                            break;
                    }
                    echo "['".$row["type"]."', ".$row["number"]."],";
                }
                ?>
            ]);
            var options = {
                title: 'Percentage of Wholesalers and Retailers',
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