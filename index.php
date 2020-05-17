<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<link rel="icon" href="https://img.icons8.com/material-sharp/50/000000/online-order.png" sizes="32x32"  />
<body class="hold-transition skin-blue layout-top-nav" style="background-color: #1ab7ea;">
<div class="pagecontent">
	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="images/b2b.jpg" alt="First slide">
                            </div>
                            <div class="item">
                                <img src="images/b2b2.jpg" alt="Second slide">
                            </div>
                            <div class="item">
                                <img src="images/b2b3.jpg" alt="Third slide">
                            </div>
                        </div>


                    </div>
                    <br>
                    <br>
	        		<?php include 'includes/sidebar.php'; ?>
	      </section>
	     

	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>