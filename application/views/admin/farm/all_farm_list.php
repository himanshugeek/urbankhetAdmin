
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

            
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> All Farm History
				
				</div>
				
                <div class="panel-body table-responsive">
				
				 <?php $msg = $this->session->flashdata('msg'); ?>
            <?php if (isset($msg)): ?>
                <div class="alert alert-success delete_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>

            <?php $error_msg = $this->session->flashdata('error_msg'); ?>
            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>
							<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Farm Name</th>
                                    <th>Farm Location</th>
                                    <th>Near Bus Stand</th>
                                    <th>Farm Type</th>
                                    <th>Soil Profile</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Farm Name</th>
                                    <th>Farm Location</th>
                                    <th>Near Bus Stand</th>
                                    <th>Farm Type</th>
                                    <th>Soil Profile</th>
                                    <th>Created Date</th>
                                </tr>
                            </tfoot>
                            
                            <tbody>
                            <?php foreach($farm as $key=>$value){ ?>
                            <tr>
                            <td><?php echo $value['farm_name']; ?></td>
                            <td><?php echo $value['farm_location']; ?></td>
                            <td><?php echo $value['bus_stand']; ?></td>
                            <td><?php echo $value['farm_type']; ?></td>
                            <td>
                            <?php 
                            $image = explode(',',$value['soil_profile']);
                            foreach($image as $k=>$v){ ?>
                            <img src="<?php echo base_url().'upload/'.$v; ?>" width=100 height=100><br/><br/>
                            <?php } ?>
                            </td>
                            <td><?php echo date('d-m-Y',strtotime($value['created_at'])); ?></td>
                            </tr>
                            <?php } ?>
                            </tbody>


                        </table>
                    </div>
					
					
            </div>
        </div>
    </div>

 </div>

    <!-- End Page Content -->