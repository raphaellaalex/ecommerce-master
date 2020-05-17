<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

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
                    <h3 class="page-header">Welcome to Business to Business E-commerce Platform!</h3>
                    <br>

                    <h4>The B2B platform was established in 2019 with one single vision, to connect all the business in Cyprus.</h4>

                    <h4> The purpose of the B2B E-commerce store is to introduce a new online marketplace where one business system sells goods and services to other business systems.</h4>

                    <h4> Whether you’re a supplier or a buyer, using an online B2B marketplace should be as easy as using any online shopping platform.
                    One year later we are still growing, with a variety of businesses and products.</h4>

                    <h4>Thank you for your support!</h4>

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
	      </section>


	    </div>
	  </div>

  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>