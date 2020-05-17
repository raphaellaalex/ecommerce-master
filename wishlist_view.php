<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>

    <div class="content-wrapper">
        <div class="container">

            <!-- Main content -->
            <form  method="POST"
            <section class="content">
                <div class="row">
                    <div class="col-sm-9">

                        <h1 class="page-header">YOUR ORDERING LIST</h1>
                        <div class="box box-solid">
                            <div class="box-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <th></th>
                                    <th>Add to cart</th>
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

        </div>
    </div>

<?php $pdo->close(); ?>
<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
    var total = 0;
    $(function(){
        $(document).on('click', '.wishlist_delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: 'wishlist_delete.php',
                data: {id:id},
                dataType: 'json',
                success: function(response){
                    if(!response.error){
                        getDetails();
                    getWishlist();
                        getTotal();
                    }
                }
            });
        });

        $(document).on('click', '.cart_add', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: 'wishlist_cart.php',
                data: {id:id},
                dataType: 'json',
                success: function(response){
                    if(!response.error){
                        getWishlist();
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
                url: 'wishlist_update.php',
                data: {
                    id: id,
                    qty: qty,
                },
                dataType: 'json',
                success: function(response){
                    if(!response.error){
                        getDetails();
                        getWishlist();
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
                url: 'wishlist_update.php',
                data: {
                    id: id,
                    qty: qty,
                },
                dataType: 'json',
                success: function(response){
                    if(!response.error){
                        getDetails();
                        getWishlist();
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
            url: 'wishlist_details.php',
            dataType: 'json',
            success: function(response){
                $('#tbody').html(response);
                getWishlist();
            }
        });
    }

    function getTotal(){
        $.ajax({
            type: 'POST',
            url: 'wishlist_total.php',
            dataType: 'json',
            success:function(response){
                total = response;
            }
        });
    }

</script>

</body>
</html>
