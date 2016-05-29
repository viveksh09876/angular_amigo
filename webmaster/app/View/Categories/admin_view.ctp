<div class="wrap-content container" id="container">
<!-- start: PAGE TITLE -->
<section id="page-title">
        <div class="row">
                <div class="col-sm-8">
                        <h1 class="mainTitle"><?php echo $category['Category']['name']; ?></h1>
                       
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
                                    <th colspan="3">Category Tags</th>
                            </tr>
                    </thead>
                    <tbody>
							<?php foreach($category['Tag'] as $tg){ ?>
                           <tr>
                                    
                                    <td><?php echo $tg['tag']; ?></td>
                            </tr>
							<?php } ?>
                            

                    </tbody>
                    </table>
                </div>
        </div>
</div>