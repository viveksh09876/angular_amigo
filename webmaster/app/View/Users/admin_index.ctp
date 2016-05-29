<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link href="<?php echo $this->webroot?>vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="<?php echo $this->webroot?>vendor/DataTables/css/DT_bootstrap.css" rel="stylesheet" media="screen">
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->  
                
                 
<div class="wrap-content container" id="container">
        <!-- start: PAGE TITLE -->
        <section id="page-title">
                <div class="row">
                        <div class="col-sm-8">
                                <h1 class="mainTitle">Users</h1>

                        </div>

                </div>
        </section>
        <!-- end: PAGE TITLE -->
        <!-- start: DYNAMIC TABLE -->
        <div class="container-fluid container-fullw bg-white">
            <div class="col-lg-12">
                                <div class="tabbable">
                                       <ul id="myTab2" class="nav nav-tabs nav-justified">
                                                <li class="active">
                                                        <a href="#myTab2_example1" data-toggle="tab">
                                                                Users
                                                        </a>
                                                </li>
                                               

                                        </ul>
                                        <div class="tab-content">
            <div class="tab-pane fade in active" id="myTab2_example1">
                    <div class="row">
                        <div class="col-md-12">

                            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                                    <thead>
                                            <tr>
                                                    <th>Name</th>
                                                    <th class="hidden-xs">Username</th>
                                                    <th>Email</th>
                                                    <th class="hidden-xs">Role</th>
                                                   
                                                    <th>User Status</th>
                                                    
                                                    <th>Actions</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            $i = 0;

                                            foreach ($Users as $user):

                                            ?>
                                            <tr>
                                                    <td><?php echo $user['User']['first_name'].' '.$user['User']['last_name']; ?></td>
                                                    <td ><?php echo $user['User']['username']; ?></td>
                                                    <td><?php echo $user['User']['email']; ?></td>
                                                    <td ><?php echo $user['UserRole']['user_role_name']; ?></td>
                                                    
                                                    
                                                    <td><?php echo $user['User']['user_status']; ?></td>
                                                  
                                                    <td style="width:100px"><div>
                                                            <a href="<?php echo $this->webroot;?>admin/users/edit/<?php echo $user['User']['user_id']; ?>" class="btn btn-transparent btn-xs"  tooltip="Edit"><i class="fa fa-pencil"></i></a>
                                                             <a href="<?php echo $this->webroot;?>admin/users/view/<?php echo $user['User']['user_id']; ?>" class="btn btn-transparent btn-xs"  tooltip="View"><i class="fa fa-eye"></i></a>
                                                            <a  onclick="show_warning('<?php echo $user['User']['user_id']; ?>')" href="javascript:void(0);" class="btn btn-transparent btn-xs tooltips"  tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
                                                    </div></td>

                                            </tr>
                                    

                                            <?php 
                                               endforeach; ?>
                                    </tbody>
                            </table>
                    </div>
            </div>
            </div>

</div>
</div>
</div>

</div>
<!-- end: DYNAMIC TABLE -->

</div>
<div class="page-container">

</div>

                            
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="<?php echo $this->webroot?>vendor/select2/select2.min.js"></script>
		<script src="<?php echo $this->webroot?>vendor/DataTables/jquery.dataTables.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="<?php echo $this->webroot?>assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="<?php echo $this->webroot?>assets/js/table-data.js"></script>
                
                  
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				TableData.init();
                               
                              
                     });  function show_warning(e){ 
                                  swal({
				title: "Are you sure?",
				text: "You will not be able to recover this!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#007AFF",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false
			}, function() {
                             window.location = '<?php echo $this->webroot;?>admin/users/delete/'+e;
				swal("Deleting...!");
			});

			e.preventDefault  
                                }
                                
                                
                                function show_subusers(id){
                                      var url = '<?php echo $this->webroot?>users/subusers/'+id; 
                                      window.open(url, '_blank');
                                }
                     
		</script>