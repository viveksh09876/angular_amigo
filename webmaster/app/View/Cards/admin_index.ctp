  <link href="<?php echo $this->webroot;?>vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.css" rel="stylesheet" media="screen">

             <div class="wrap-content container" id="container">
                <!-- start: DASHBOARD TITLE -->
                <section id="page-title" class="padding-top-15 padding-bottom-15">
                        <div class="row">
                                <div class="col-sm-7">
                                       <h1 class="mainTitle">Cards</h1>
                                      
                                </div>
                                
                        </div>

                </section>
                
            
<div class="container-fluid container-fullw">
<div class="row">
        <div class="col-md-12">
               <table class="table table-striped table-hover" id="sample-table-2">
                        <thead>
                                <tr>
                                        <th class="center">S.N.</th>
                                        <th class="hidden-xs">Image</th>
										<th class="hidden-xs">Title</th>
										<th class="hidden-xs">Place</th>
                                       
										<th class="hidden-xs">Status</th>
										<th class="hidden-xs">Added Date</th>
                                        
                                        <th class="hidden-xs">Actions</th>
                                </tr>
                        </thead>
                        <tbody>
                            <?php  if($Cards){ $i=1; 
                            
                                foreach($Cards as $cate){?>
                                <tr>
                                        <td class="center"><?php echo $i; ?></td>
                                        <td class="hidden-xs"><?php if(!empty($cate['Image'])){ ?>
											<img src="<?php echo $this->webroot; ?>img/places/<?php echo $cate['Image'][0]['photo']; ?>" style="max-width: 100px;"/>
										<?php }else{ ?> 
											<img src="<?php echo $this->webroot; ?>img/places/image_not_available.jpg" style="max-width: 100px;"/>
										<?php } ?></td>
										<td class="hidden-xs"><?php echo $cate['UserStory']['title']; ?></td>
                                        <td class="hidden-xs"><?php echo $cate['Place'][0]['place_name']; ?></td>
										
                                        <td class="hidden-xs"><?php if($cate['UserStory']['status'] == 1) { echo 'Active'; }elseif($cate['UserStory']['status'] == 0) { echo 'De-active'; }else if($cate['UserStory']['status'] == 2) { echo 'Deleted'; } ?></td>
										<td class="hidden-xs"><?php echo $cate['UserStory']['created']; ?></td>
                                        <td style="width:100px">
                                            <div>
                                                <!--<a href="<?php echo $this->webroot;?>admin/cards/edit/<?php echo $cate['UserStory']['id']; ?>" class="btn btn-transparent btn-xs"  tooltip="Edit"><i class="fa fa-pencil"></i></a>
												<a href="<?php echo $this->webroot;?>admin/cards/view/<?php echo $cate['UserStory']['id']; ?>" class="btn btn-transparent btn-xs"  tooltip="View"><i class="fa fa-eye"></i></a>-->
                                                <a  onclick="show_warning('<?php echo $cate['UserStory']['id']; ?>')" href="javascript:void(0);" class="btn btn-transparent btn-xs tooltips"  tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
                                            </div>
                                        </td>
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
 </div>

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
             window.location = '<?php echo $this->webroot;?>admin/cards/delete/'+e;
                swal("Deleting...!");
        });

        e.preventDefault  
      }


</script>

