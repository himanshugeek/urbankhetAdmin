
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

            
           <div class="panel panel-info">
                <div class="panel-heading"> 
                     <i class="fa fa-plus"></i> &nbsp;Add Farm

                </div>
                <div class="panel-body table-responsive">
				
				 <?php $error_msg = $this->session->flashdata('error_msg'); ?>
            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>
			    <form method="post" action="<?php echo base_url('admin/farm/add') ?>" class="form-horizontal" novalidate>
                    <div class="form-group">
                 	<label class="col-md-12" for="example-text">Farmer</label>
                        <div class="col-sm-12">
                            <select class="custom-select col-12" id="farmer" name="farmer_id">
                                <option selected>Choose Farmer</option>
                                <?php foreach($farmer as $key => $value){ ?>
                                <option value="<?php echo $value['id'] ?>"><?php echo $value['first_name']; ?> <?php echo $value['last_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        </div>
                              

                    <div class="form-group">
                 	    <label class="col-md-12" for="example-text">Farm Name</label>
                        <div class="col-sm-12">
                        <input class="form-control" type="text" name="farm_name" value="" id="farm_name">
                        </div>
                    </div>
                              
                    <div class="form-group">
                 	    <label class="col-md-12" for="example-text">Farm Location</label>
                        <div class="col-sm-12">
                        <input class="form-control" type="text" name="farm_location" value="" id="farm_location">
                        </div>
                    </div>
                              
                    <div class="form-group">
                 	    <label class="col-md-12" for="example-text">Farm Type</label>
                        <div class="col-sm-12">
                        <select class="custom-select col-12" id="farm_type" name="farm_type">
                            <option>Select Farm Type</option>
                        <?php foreach($farm_type as $key=>$value) { ?>
                            <option value="<?php echo $value ?>"><?php echo $value ?></option>
                        <?php } ?>
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                 	    <label class="col-md-12" for="example-text">Nearest bus stand</label>
                        <div class="col-sm-12">
                        <input class="form-control" type="text" name="bus_stand" value="" id="bus_stand">
                        </div>
                    </div>
    					  
                       <hr>   
                            <!-- CSRF token -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
  <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info btn-rounded btn-sm"> <i class="fa fa-plus"></i>&nbsp;&nbsp;Save</button>
                            </div>
                        </div>
                           
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End Page Content -->
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
var BASE_URL = "<?php echo base_url();?>";
$(document).ready(function(){
    $('#farmer').on('change',function(){
        var farmer_id = $(this).val();
        var cct = $.cookie("<?php echo  $this->security->get_csrf_hash(); ?>");
        alert(cct);
        if(farmer_id){
            $.ajax({
                type:'POST',
                url: BASE_URL+'admin/harvest/getcrop',
                data:{'farmer_id': farmer_id, 'csrf_token_name': cct},
                datatype: 'json',
                success:function(html){
                    $('#crop_id').html(html); 
                }
            }); 
        }
    });
});
</script>