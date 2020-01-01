<?php include 'layout/css.php'; ?>

    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper"> 
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="icon-grid"></i></a>
                <div class="top-left-part"><a class="logo" href="<?php echo base_url('admin/dashboard/') ?>"><b><img src="<?php echo base_url();?>optimum/small.png" alt="Codeig" /></b><span class="hidden-xs">UrbanKhet</span></a></div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs"><i class="icon-grid"></i></a></li>
                   
                </ul>
				
				<ul class="nav navbar-top-links navbar-right pull-right">
                
                    <!-- /.dropdown -->
					
					
				

 
										
						
						
                        <!-- /.dropdown-messages -->
                
                    <!-- /.dropdown -->
					
					
					
					
					
					 
                        <!-- /.dropdown-messages -->
                   
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?php echo base_url();?>optimum/images/admin.jpg" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $this->session->userdata('name'); ?></b> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li><a href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-power-off"></i>  Logout</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    	<!--<li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>-->
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <!-- input-group -->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search<?php echo base_url();?>optimum."> <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                        <!-- /input-group -->
                    </li>
                    <li class="user-pro">
                        <a href="#" class="waves-effect"><img src="<?php echo base_url();?>optimum/images/admin.jpg" alt="user-img" class="img-circle"> <span class="hide-menu"><?php echo $this->session->userdata('name'); ?><span class="fa arrow"></span></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </li>
                    <li> <a href="<?php echo base_url('admin/dashboard') ?>" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu">Dashboard</span></a> </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-user p-r-10"></i> <span class="hide-menu"> Create User <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
						<?php if ($this->session->userdata('role') == 'admin'): ?>
                             <li> <a href="<?php echo base_url('admin/user') ?>"><i class="fa fa-plus p-r-10"></i><span class="hide-menu">New User</span></a></li>
							 <!-- <li> <a href="<?php echo base_url('admin/user/power') ?>"><i class="fa fa-cog p-r-10"></i><span class="hide-menu">User Function</span></a></li> -->
							  <?php else: ?>
							   <?php if(check_power(1)):?>
                            <li> <a href="<?php echo base_url('admin/user') ?>"><i class="fa fa-plus p-r-10"></i><span class="hide-menu">New User</span></a></li>
                            <?php endif; ?>
                            <?php endif ?>
						<li><a href="<?php echo base_url('admin/user/all_user_list') ?>"><i class="fa fa-list p-r-10"></i><span class="hide-menu">All Users</span></a></li>
                      </ul>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-user p-r-10"></i> <span class="hide-menu"> Crops <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
						<?php if ($this->session->userdata('role') == 'admin'): ?>
                            <li> <a href="<?php echo base_url('admin/harvest') ?>"><i class="fa fa-plus p-r-10"></i><span class="hide-menu">Add Upcoming Harvest</span></a></li>
                            <li><a href="<?php echo base_url('admin/harvest/all_harvest_list') ?>"><i class="fa fa-list p-r-10"></i><span class="hide-menu">Harvest History</span></a></li>
                        <?php endif ?>
                        </ul>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-user p-r-10"></i> <span class="hide-menu"> Farm <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
						<?php if ($this->session->userdata('role') == 'admin'): ?>
                            <li><a href="<?php echo base_url('admin/farm') ?>"><i class="fa fa-plus p-r-10"></i><span class="hide-menu">Add Farm</span></a></li>
                            <li><a href="<?php echo base_url('admin/farm/all_farm_list') ?>"><i class="fa fa-list p-r-10"></i><span class="hide-menu">Farm History</span></a></li>
                        <?php endif ?>
                        </ul>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-user p-r-10"></i> <span class="hide-menu"> Crop List <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
						<?php if ($this->session->userdata('role') == 'admin'): ?>
                            <li><a href="<?php echo base_url('admin/crop') ?>"><i class="fa fa-list p-r-10"></i><span class="hide-menu">Crop History</span></a></li>
                            <!-- <li><a href="<?php echo base_url('admin/crop/addCropHarvestDate') ?>"><i class="fa fa-list p-r-10"></i><span class="hide-menu">Crop Harvesting Date</span></a></li> -->
                        <?php endif ?>
                        </ul>
                    </li>
                    

					
				
			
                    
            
                   
                    
                    
                    <li><a href="<?php echo base_url('auth/logout') ?>" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
       
	   
	    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                
			<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">UrbanKhet</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>admin/dashboard/">Home</a></li>
                            <li class="active"> <?php echo $page_title; ?></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div> 	
				
				
				
				
				<!--  row    ->
               <?php echo $main_content; ?>
                <!-- /.row -->
			
            </div>
            <!-- /.container-fluid -->
           <?php include 'layout/footer.php'; ?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
   <?php include 'layout/js.php'; ?>
