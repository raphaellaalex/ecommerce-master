<!-- Add -->
<div class="modal fade" id="profile">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Supplier Profile</b></h4>
          	</div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="profile_update.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $supplier['firstname']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $supplier['lastname']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Company Name</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $supplier['company_name']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $supplier['email']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Password</label>

                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" value="<?php echo $supplier['password']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact_info" class="col-sm-3 control-label">Contact Info</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="contact_info" name="contact_info" value="<?php echo $supplier['contact_info']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="col-sm-3 control-label">City</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="city" name="city" value="<?php echo $supplier['city']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-sm-3 control-label">Address</label>

                        <div class="col-sm-9">
                            <textarea class="form-control" id="address" name="address"><?php echo $supplier['address']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo" class="col-sm-3 control-label">Photo</label>

                        <div class="col-sm-9">
                            <input type="file" id="photo" name="photo">
                        </div>
                    </div>
                    <hr>

                    <div class="form-group">
                        <label for="curr_password" class="col-sm-3 control-label">Current Password</label>

                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="curr_password" name="curr_password" placeholder="input current password to save changes" required>
                        </div>
                    </div>
            </div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="save"><i class="fa fa-check-square-o"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>