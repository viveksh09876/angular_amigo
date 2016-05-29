<div class="wrap-content container" id="container">
<!-- start: PAGE TITLE -->
<section id="page-title">
        <div class="row">
                <div class="col-sm-8">
                        <h1 class="mainTitle"><?php echo $User['User']['first_name'].' '.$User['User']['last_name']; ?></h1>
                       
                </div>
                <div class="invoice-logo">
                    <div class="col-sm-4 thumbnail">
                        <?php if($User['User']['image']){?>
                            <img alt="" src="<?php echo $User['User']['image']; ?>">
                        <?php }else{ ?><img alt="" src="<?php echo $this->webroot; ?>assets/images/avatar.png"><?php } ?>
                    </div>
            </div>
        </div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">
        <div class="row">
                <div class="col-md-12">
                    <table class="table table-condensed">
                    <thead>
                            <tr>
                                    <th colspan="3">Contact Information</th>
                            </tr>
                    </thead>
                    <tbody>
                           <tr>
                                    <td>Name:</td>
                                    <td>
                                    <a href="javascript:void(0)">
                                            <?php echo $User['User']['first_name']; ?>
                                    </a></td>
                                    <td></td>
                            </tr>
                            <tr>
                                    <td>Username:</td>
                                    <td>
                                    <a href="javascript:void(0)">
                                            <?php echo $User['User']['username']; ?>
                                    </a></td>
                                    <td></td>
                            </tr>
                            <tr>
                                    <td>email:</td>
                                    <td>
                                    <a href="javascript:void(0)">
                                            <?php echo $User['User']['email']; ?>
                                    </a></td>
                                    <td></td>
                            </tr>
                            

                    </tbody>
                    </table>
                   <table class="table">
                <thead>
                        <tr>
                                <th colspan="3">General information</th>
                        </tr>
                </thead>
                <tbody>
                    
                    <tr>
                                <td>User Added Date</td>
                                <td>
                                <a href="javascript:void(0)">
                                        <?php echo $User['User']['user_added_date']; ?>
                                </a></td>
                               
                        </tr>
                        

                        <tr>
                                <td>Status</td>
                                <td><span class="label label-sm label-info"> <?php echo $User['User']['user_status']; ?></span></td>
                                
                        </tr>
                </tbody>
                </table>      
                </div>
        </div>
</div>