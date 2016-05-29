<div class="sidebar app-aside" id="sidebar">
<div class="sidebar-container perfect-scrollbar">
        <nav>
                <!-- start: SEARCH FORM -->

                <!-- end: SEARCH FORM -->
                <!-- start: MAIN NAVIGATION MENU -->
                <div class="navbar-title">

                </div>
                      <ul class="main-navigation-menu">
                        <li <?php if($this->name=='Dashboard'){?> class="active open" <?php }?>>
                                <a href="<?php echo $this->webroot;?>admin/dashboard/index">
                                        <div class="item-content">
                                                <div class="item-media">
                                                        <i class="ti-home"></i>
                                                </div>
                                                <div class="item-inner">
                                                        <span class="title"> Dashboard </span>
                                                </div>
                                        </div>
                                </a>
                        </li>
                        <li <?php if($this->name=='Users'){?> class="active open" <?php }?>>
                        <a href="javascript:void(0)">
                                        <div class="item-content">
                                                <div class="item-media">
                                                        <i class="ti-user"></i>
                                                </div>
                                                <div class="item-inner">
                                                        <span class="title"> Users </span><i class="icon-arrow"></i>
                                                </div>
                                        </div>
                                </a>
                                <ul class="sub-menu">
                                        <li <?php if(($this->action=='admin_add') && ($this->name=='Users')){?> class="active" <?php }?>>
                                                <a href="<?php echo $this->webroot;?>admin/users/add">
                                                        <span class="title">Add New User</span>
                                                </a>
                                        </li>
                                        <li <?php if(($this->action=='admin_index') &&  ($this->name=='Users')){?> class="active" <?php }?>>
                                                <a href="<?php echo $this->webroot;?>admin/users/index">
                                                        <span class="title"> List Users</span>
                                                </a>
                                        </li>

                                </ul>

                        </li>
                         <li <?php if($this->name=='Categories'){?> class="active open" <?php }?>>
                        <a href="javascript:void(0)">
                                        <div class="item-content">
                                                <div class="item-media">
                                                       <i class="fa fa-bars" aria-hidden="true"></i>

                                                </div>
                                                <div class="item-inner">
                                                        <span class="title"> Categories </span><i class="icon-arrow"></i>
                                                </div>
                                        </div>
                                </a>
                                <ul class="sub-menu">
                                        <li <?php if(($this->action=='admin_add') && ($this->name=='Categories')){?> class="active" <?php }?>>
                                                <a href="<?php echo $this->webroot;?>admin/categories/add">
                                                        <span class="title">Add Category</span>
                                                </a>
                                        </li>
                                        <li <?php if(($this->action=='admin_index') &&  ($this->name=='Categories')){?> class="active" <?php }?>>
                                                <a href="<?php echo $this->webroot;?>admin/categories/index">
                                                        <span class="title"> List Categories</span>
                                                </a>
                                        </li>

                                </ul>

                        </li>
						
				<li <?php if($this->name=='Cards'){?> class="active open" <?php }?>>
                        <a href="javascript:void(0)">
                                        <div class="item-content">
                                                <div class="item-media">
                                                       <i class="fa fa-bars" aria-hidden="true"></i>

                                                </div>
                                                <div class="item-inner">
                                                        <span class="title"> Cards </span><i class="icon-arrow"></i>
                                                </div>
                                        </div>
                                </a>
                                <ul class="sub-menu">
                                        
                                        <li <?php if(($this->action=='admin_index') &&  ($this->name=='Cards')){?> class="active" <?php }?>>
                                                <a href="<?php echo $this->webroot;?>admin/cards/index">
                                                        <span class="title"> List Cards</span>
                                                </a>
                                        </li>

                                </ul>

                        </li>

				<li <?php if($this->name=='Trips'){?> class="active open" <?php }?>>
                        <a href="javascript:void(0)">
                                        <div class="item-content">
                                                <div class="item-media">
                                                       <i class="fa fa-bars" aria-hidden="true"></i>

                                                </div>
                                                <div class="item-inner">
                                                        <span class="title"> Trips </span><i class="icon-arrow"></i>
                                                </div>
                                        </div>
                                </a>
                                <ul class="sub-menu">
                                        
                                        <li <?php if(($this->action=='admin_index') &&  ($this->name=='Trips')){?> class="active" <?php }?>>
                                                <a href="<?php echo $this->webroot;?>admin/trips/index">
                                                        <span class="title"> List Trips</span>
                                                </a>
                                        </li>

                                </ul>

                        </li>

                </ul>
                <!-- end: MAIN NAVIGATION MENU -->

                
        </nav>
</div>
</div>
                        <!-- / sidebar -->