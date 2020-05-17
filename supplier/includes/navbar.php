<header class="main-header">

    <!-- logo for regular state and mobile devices -->
<!--      <span class="logo-lg"><b>B2B E-commerce</b></span>-->
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo (!empty($supplier['photo'])) ? '../images/'.$supplier['photo'] : '../images/profile.png'; ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $supplier['firstname'].' '.$supplier['lastname']; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?php echo (!empty($supplier['photo'])) ? '../images/'.$supplier['photo'] : '../images/profile.png'; ?>" class="img-circle" alt="User Image">

              <p>
                <?php echo $supplier['firstname'].' '.$supplier['lastname']; ?>
                <small>Member since <?php echo date('M. Y', strtotime($supplier['created_on'])); ?></small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="#profile" data-toggle="modal" class="btn btn-default btn-flat" id="admin_profile">Update</a>
              </div>
              <div class="pull-right">
                <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<?php include 'includes/profile_modal.php'; ?>