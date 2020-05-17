<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<head>
    <link rel="stylesheet" type="text/css" href="dist/css/AdminLTE.css">
</head>
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
                    <br>
                    <br>
                    <h3 class="glyphicon glyphicon-map-marker">  Find us</h3>
                    <h6>Cyprus, Limassol,3041</h6>
                    <h6>Cyprus University of Technology</h6>
                    <h6>Megalou ALexandrou</h6>
                    <br>
                    <h3 class="glyphicon glyphicon-phone">  Contact us</h3>
                    <h6>raphaella.alexandraki.thesis@gmail.com</h6>
                    <h6>99999999</h6>
                    <br>
                    <div class="login-box-body">

                        <p class="login-box-msg">Send us an email!</p>

                        <form action="contactUs.php" method="POST">
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                            </div>
                            <div class="form-group has-feedback">
                                <textarea class="form-control" name="body" placeholder="Write something.." style="height: 100px" required></textarea>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="contact"><i class="glyphicon glyphicon-send "></i>   Contact Us  </button>
                                </div>
                            </div>
                        </form>
                    </div>
	      </section>


	    </div>
	  </div>

  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>