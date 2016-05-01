  <link href="<?php echo $this->webroot;?>vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.css" rel="stylesheet" media="screen">

             <div class="wrap-content container" id="container">
                <!-- start: DASHBOARD TITLE -->
                <section id="page-title" class="padding-top-15 padding-bottom-15">
                        <div class="row">
                                <div class="col-sm-7">
                                       <h1 class="mainTitle">Categories</h1>
                                      
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
                                        <th class="hidden-xs">Name</th>
                                        <th class="hidden-xs">Added Date</th>
                                        <th class="hidden-xs">Modified Date</th>
                                        <th class="hidden-xs">Actions</th>
                                </tr>
                        </thead>
                        <tbody>
                            <?php  if($Categories){ $i=1; 
                            
                                foreach($Categories as $cate){?>
                                <tr>
                                        <td class="center"><?php echo $i; ?></td>
                                        <td class="hidden-xs"><?php echo $cate['Category']['name']; ?></td>
                                        <td class="hidden-xs"><?php echo $cate['Category']['created']; ?></td>
                                        <td class="hidden-xs"><?php echo $cate['Category']['modified']; ?></td>
                                        <td style="width:100px">
                                            <div>
                                                <a href="<?php echo $this->webroot;?>admin/categories/edit/<?php echo $cate['Category']['id']; ?>" class="btn btn-transparent btn-xs"  tooltip="Edit"><i class="fa fa-pencil"></i></a>
                                                <a  onclick="show_warning('<?php echo $cate['Category']['id']; ?>')" href="javascript:void(0);" class="btn btn-transparent btn-xs tooltips"  tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
             window.location = '<?php echo $this->webroot;?>admin/categories/delete/'+e;
                swal("Deleting...!");
        });

        e.preventDefault  
      }


</script>

