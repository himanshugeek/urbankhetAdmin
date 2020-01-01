
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
                            <th>Crop Name</th>
                                    <th>Farmer Name</th>
                                    <th>Farm Name</th>
                                    <th>Crop Type</th>
                                    <th>Production Amount</th>
                                    <th>Sedding Date</th>
                                    <th>Expected Harvest Date</th>
                                    <th>Sedding Detail</th>
                                    <th>Fertilizer Detail</th>
                                    <th>Pesticide Detail</th>
                                    <th>Current Crop Image</th>
                                    <th>Created Date</th>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Crop Name</th>
                                    <th>Farmer Name</th>
                                    <th>Farm Name</th>
                                    <th>Crop Type</th>
                                    <th>Production Amount</th>
                                    <th>Sedding Date</th>
                                    <th>Expected Harvest Date</th>
                                    <th>Sedding Detail</th>
                                    <th>Fertilizer Detail</th>
                                    <th>Pesticide Detail</th>
                                    <th>Current Crop Image</th>
                                    <th>Created Date</th>
                                </tr>
                            </tfoot>
                            
                            <tbody>
                            <?php foreach($crop as $key=>$value){ ?>
                            <tr>
                            <td><?php echo $value['crop_name']; ?></td>
                            <td><?php echo $value['first_name']; ?>&nbsp;<?php echo $value['last_name']; ?></td>
                            <td><?php echo $value['farm_name']; ?></td>
                            <td><?php echo $value['crop_type']; ?></td>
                            <td><?php echo $value['product_amount']; ?></td>
                            <td><?php echo date('d-m-Y',strtotime($value['seeding_date'])); ?></td>
                            <td><?php echo date('d-m-Y',strtotime($value['expected_harvest_date'])); ?></td>
                            <td>
                            <?php
                            if($value['seed_detail'] != NULL) {
                            $image = explode(',',$value['seed_detail']);
                            foreach($image as $k=>$v){ ?>
                            <img src="<?php echo base_url().'upload/seed/'.$v; ?>" width=100 height=100><br/><br/>
                            <?php }} ?>
                            </td>
                            <td>
                            <?php
                            if($value['fertilizer_details'] != NULL) {
                            $image = explode(',',$value['fertilizer_details']);
                            foreach($image as $k=>$v){ ?>
                            <img src="<?php echo base_url().'upload/fertilizer/'.$v; ?>" width=100 height=100><br/><br/>
                            <?php }} ?>
                            </td>
                            <td>
                            <?php
                            if($value['pesticide_details'] != NULL) {
                            $image = explode(',',$value['pesticide_details']);
                            foreach($image as $k=>$v){ ?>
                            <img src="<?php echo base_url().'upload/pesticide/'.$v; ?>" width=100 height=100><br/><br/>
                            <?php }} ?>
                            </td>
                            <td>
                            <?php
                            if($value['current_crop_image'] != NULL) {
                            $image = explode(',',$value['current_crop_image']);
                            foreach($image as $k=>$v){ ?>
                            <img src="<?php echo base_url().'upload/crop/'.$v; ?>" width=100 height=100>
                            <?php }} ?>
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