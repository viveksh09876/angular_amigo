<div class="wrap-content container" id="container">
<!-- start: PAGE TITLE -->
<section id="page-title">
        <div class="row">
                <div class="col-sm-8">
                        <h1 class="mainTitle"><?php echo $trip['Trip']['title']; ?></h1>
                       
                </div>
                
        </div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">
        <div class="row">
                <div class="col-md-6">
                    <table class="table table-condensed">
                    <thead>
                            <tr>
                                    <th colspan="2"><h4>Trip Details</h4></th>
                            </tr>
                    </thead>
                    <tbody>
							<tr>
								<td><strong>Notes</strong></td>
								<td><?php echo $trip['Trip']['notes']; ?></td>
							</tr>
							<tr>
								<td><strong>Status</strong></td>
								<td><?php if($trip['Trip']['status'] == 1) echo 'Active'; else echo 'Inactive'; ?></td>
							</tr>
                    </tbody>
                    </table>
                </div>
        </div>
		<div class="row">
                <div class="col-md-12">
                    <table class="table table-condensed">
                    <thead>
							<tr>
                                 <th colspan="3"><h4>Trip Cards</h4></th>
                            </tr>
                            <tr>
                                 <th>Image</th>
								 <th>Place</th>
								 <th>Day</th>
								 
                            </tr>
                    </thead>
                    <tbody>
						<?php
							$day = array(); $i = 1;
							foreach($trip['TripCard'] as $tc){  
								if(!in_array($tc['day'], $day)){
							?>
							<tr>
								<td><img src="<?php 
											if(isset($tc['UserStory']['Image']) && !empty($tc['UserStory']['Image'])) {
												echo $this->webroot.'img/places/'.$tc['UserStory']['Image'][0]['photo'];
											}else{
												echo $this->webroot.'img/places/image_not_available.jpg';
											} 
									?>" style="max-width: 100px; " /></td>
								<td><?php echo $tc['UserStory']['Place'][0]['place_name']; ?></td>
								<td><?php echo $i; ?></td>
							</tr>
						<?php $day[] = $i;  $i++; }else{ ?>
							<tr>
								<td colspan="3">
									<div style="height: 50px; background-color: #999; text-align:center; "><h3 style="color: #fff; padding: 10px;">Day break</h3></div>
								</td>
							</tr>
						<?php }  } ?>	
                    </tbody>
                    </table>
                </div>
        </div>
</div>