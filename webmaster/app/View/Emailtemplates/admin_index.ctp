	  <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link href="<?php echo $this->webroot?>vendor/sweetalert/sweet-alert.css" rel="stylesheet" media="screen">
		<link href="<?php echo $this->webroot?>vendor/sweetalert/ie9.css" rel="stylesheet" media="screen">
		<link href="<?php echo $this->webroot?>vendor/toastr/toastr.min.css" rel="stylesheet" media="screen">
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY --><div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Email Templates</h1>
								</div>
							
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
                                                <div class="container-fluid container-fullw bg-white">
                                                    
                                                    <div class="row">
        <div class="col-md-12">
               <table class="table table-striped table-hover" id="sample-table-2">
                        <thead>
                                
                                    <tr>
	<th class="center"><?php echo $this->Paginator->sort('template_id','ID');?></th>
			<th class="hidden-xs"><?php echo $this->Paginator->sort('template_name','Name');?></th>
            <th class="hidden-xs"><?php echo $this->Paginator->sort('Key');?></th> 
           <!-- <th><?php //echo $this->Paginator->sort('Profit To Admin');?></th> -->
			<th class="hidden-xs"><?php echo $this->Paginator->sort('added_date');?></th>
			<th class="hidden-xs"><?php echo $this->Paginator->sort('last_modified_date');?></th>
            <th class="hidden-xs"><?php echo $this->Paginator->sort('status');?></th>	
			<th class="center"><?php echo __('Actions');?></th>
	</tr>
                                    
                        </thead>
                        <tbody>
                            <?php  if($Templates){ $i=1; 
                            
                              foreach ($Templates as $templates){?>
                                <tr>
	<td><?php echo $templates['EmailTemplate']['id'];?></td>
		<td><?php echo $templates['EmailTemplate']['template_name'];?></td>
		<td><?php echo $templates['EmailTemplate']['template_key'];?></td>
	<!--	<td><?php // if($restaurant['Restaurant']['restaurant_admin_profit']){echo $restaurant['Restaurant']['restaurant_admin_profit'].'%';}else{echo 'N/A';}?></td> -->
		<td><?php echo date("d M Y h:i A",strtotime($templates['EmailTemplate']['template_added_date']));  ?></td>
		<td><?php if($templates['EmailTemplate']['template_modified_date']!='') echo date("d M Y h:i A",strtotime($templates['EmailTemplate']['template_modified_date'])); ?></td>
		<td><?php echo $templates['EmailTemplate']['template_status']; ?></td>
                <td class="center"> <div class="visible-md visible-lg hidden-sm hidden-xs">
                <a href="<?php echo $this->webroot;?>admin/emailtemplates/edit/<?php echo $templates['EmailTemplate']['id']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>

                <a  onclick="show_warning('<?php echo $templates['EmailTemplate']['id']; ?>')" href="javascript:void(0);" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
        </div></td>
		
	</tr>
                            <?php $i++;}
                            }else{?>
                                <tr><td colspan="7">No Record Found</td></tr>
                            <?php } ?>
                                
                        </tbody>
                </table>
            
            <div class="paging">
		<ul class="pagination">
                <?php
                echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                $numbers = $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
                $numbers = preg_replace("#\<li class=\"active\"\>([0-9]+)\<\/li\>#", "<li class=\"active\"><a href=''>$1</a></li>",$numbers);
                echo $numbers;
                echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                ?>
                </ul>
	</div>
        </div>
    
</div>

	</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
						
					</div>


<script src="<?php echo $this->webroot?>vendor/sweetalert/sweet-alert.min.js"></script>
		<script src="<?php echo $this->webroot?>vendor/toastr/toastr.min.js"></script>
                <script src="<?php echo $this->webroot?>assets/js/ui-notifications.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			 function show_warning(e){ 
                                  swal({
				title: "Are you sure?",
				text: "You will not be able to recover this!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#007AFF",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false
			}, function() {
                             window.location = '<?php echo $this->webroot;?>admin/emailtemplates/delete/'+e;
				swal("Deleting...!");
			});

			e.preventDefault  
                                }
                     
		</script>