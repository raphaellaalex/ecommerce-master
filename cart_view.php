<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
          <form action="sales.php"  method="POST"
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<h1 class="page-header">YOUR CART</h1>
	        		<div class="box box-solid">
	        			<div class="box-body">
		        		<table class="table table-bordered">
		        			<thead>
		        				<th></th>
		        				<th>Photo</th>
		        				<th>Name</th>
		        				<th>Price</th>
		        				<th width="20%">Quantity</th>
		        				<th>Subtotal</th>
		        			</thead>
		        			<tbody id="tbody">
		        			</tbody>
		        		</table>
	        			</div>
	        		</div>
	        	</div>

	        </div>
	      </section>
            <section class="content">
                <div class="row">
                    <div class="col-sm-9">
                        <h1 class="page-header">BILLING DETAILS</h1>
                        <?php
                        if(isset($_SESSION['error'])){
                            echo "
	        					<div class='callout callout-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
                            unset($_SESSION['error']);
                        }

                        if(isset($_SESSION['success'])){
                            echo "
	        					<div class='callout callout-success'>
	        						".$_SESSION['success']."
	        					</div>
	        				";
                            unset($_SESSION['success']);
                        }
                        ?>

                        <div class="box box-solid">
                            <div class="box-body">

                                        <div class="col-sm-3">
                                            <h4>Name:</h4>
                                            <h4>Company:</h4>
                                            <h4>Email:</h4>
                                            <h4>Contact Info:</h4>
                                            <h4>City:</h4>
                                            <h4>Address:</h4>
                                        </div>
                                        <form action="confirm.php">
                                            <div class="col-sm-9">
                                                <h4><?php echo (!empty($user['firstname'])) ? ($user['firstname'].' '.$user['lastname']) : 'N/a'; ?>
                                                </h4>
                                                <h4><?php echo (!empty($user['company_name'])) ? $user['company_name'] : 'N/a'; ?></h4>
                                                <h4><?php echo (!empty($user['email'])) ? $user['email'] : 'N/a'; ?></h4>
                                                <h4><?php echo (!empty($user['contact_info'])) ? $user['contact_info'] : 'N/a'; ?></h4>
                                                <h4><?php echo (!empty($user['city'])) ? $user['city'] : 'N/a'; ?></h4>
                                                <h4><?php echo (!empty($user['address'])) ? $user['address'] : 'N/a'; ?></h4>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if(isset($_SESSION['user'])){
                            echo "
	        					<div id='paypal-button'></div>
	        				";
                        }
                        else{
                            echo "
	        					<h4>You need to <a href='login.php'>Login</a> to checkout.</h4>
	        				";
                        }
                        ?>
                    </div>
                </div>
            </section>

	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
var total = 0;
$(function(){
	$(document).on('click', '.cart_delete', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'cart_delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.minus', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		if(qty>1){
			qty--;
		}
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.add', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		qty++;
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	getDetails();
	getTotal();

});

function getDetails(){
	$.ajax({
		type: 'POST',
		url: 'cart_details.php',
		dataType: 'json',
		success: function(response){
			$('#tbody').html(response);
			getCart();
		}
	});
}

function getTotal(){
	$.ajax({
		type: 'POST',
		url: 'cart_total.php',
		dataType: 'json',
		success:function(response){
			total = response;
		}
	});
}
</script>
<script>
    paypal.Button.render({
        env: 'sandbox', // because app is not live

        client: {
            sandbox:    'AaaUVE7BHmkmPab_0UIhQya6m5iC6zueT9_0bHODEagQTbMX7rGsQT90aXD6Je9E_Nu6MVxLhxtEEC1q',
        },

        commit: true, // Show a 'Pay Now' button

        style: {
            color: 'gold',
            size: 'small'
        },

        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            //total purchase
                            amount: {
                                total: total,
                                currency: 'EUR'
                            }
                        }
                    ]
                }
            });
        },

        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function(payment) {
                window.location = 'sales.php?pay='+payment.id;
            });
        },

    }, '#paypal-button');
</script>
</body>
</html>