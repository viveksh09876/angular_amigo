<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php echo $this->Html->charset(); ?>
<title><?php echo $title_for_layout; ?></title>
<?php
echo $this->Html->meta('icon');
echo $this->Html->meta(array('name' => 'robots', 'content' => 'noindex, nofollow'));

echo $this->Html->css(array('cake.generic','style','form','tables','jquery-te/jquery-te-1.4.0','jquery-ui-1.8.21.custom'));
echo $this->Html->script(array('jquery.min','jquery-te/jquery-te-1.4.0.min','jquery-ui-1.8.21.custom.min','common'));
echo $scripts_for_layout;
?>
<script type="text/javascript">
jQuery(function(){
	if(jQuery('textarea').hasClass('text-editor')){
		jQuery('.text-editor').jqte();
	}
});
</script>
<?php
$this->UserRole = ClassRegistry::init('UserRole');
$UsersType = $this->UserRole->find('all',array('conditions'=>array('user_role_status'=>'Active','user_role_id !='=>'1'))); 

?>
</head>


<body>

<div id="wrapper">

<div id="header">
<noscript>
<div class="notice"><span>This is a Warning Notice!</span>
<p>You will need to enable JavaScript on your browser.</p>
</div>
</noscript>

<?php 
if($loggedIn){	
?>
<span style="float: right;"> Welcome [<?php echo $loggedUser['name'];?>]<br />
<small style="color:red">Last Login: <?php if(!empty($loggedUser['last_login_date'])){echo date('d/m/Y H:i:s a',strtotime($loggedUser['last_login_date']));}?></small>
<br/>
<a href="<?php echo $this->webroot;?>logins/logout">Logout</a>
</span>
<?php }?>

<h3><a href="<?php echo $this->webroot;?>admin/home">
<img src="<?php echo $this->webroot;?>img/frontend/logo.png" alt="logo"/></a>
</h3>
</div>
<!-- [end]#header -->


<div id="menu">
<ul id="navmenu">

	<li><?php
	if(strtolower($this->name)=='home'){
		echo $this->Html->link('Dashboard',array('controller' => 'home', 'action' => 'index','admin'=>true),array('class' => 'current'));
	}else{
		echo $this->Html->link('Dashboard',array('controller' => 'home', 'action' => 'index','admin'=>true));
	}
	?>
	</li>
    
        
    <!------------master-------->
	<li><?php
	if(strtolower($this->name)=='master'){
		echo $this->Html->link('Master',array('controller' => 'master', 'action' => 'bank_list','admin'=>true),array('class' => 'current'));
	}else{
		echo $this->Html->link('Master',array('controller' => 'master', 'action' => 'bank_list','admin'=>true));
	}
	?>
     <ul class="nav_submenu submenu">
    		<?php //echo $this->Html->link('Bank',array('controller' => 'master', 'action' => 'bank_list','admin'=>true));?>
		<?php //echo $this->Html->link('Bank Details',array('controller' => 'master', 'action' => 'bank_details_list','admin'=>true));?>
           	<li><?php echo $this->Html->link('SMS API',array('controller' => 'master', 'action' => 'sms_api_list','admin'=>true));?></li>
		</ul>
	</li>
	
    
    
    
    <li><?php
	
	$filterBy = '1';

	if(in_array(strtolower($this->name),array('users','wallet')) && in_array(strtolower($this->action),
	array('admin_index','admin_add_wallet_amount','admin_remove_wallet_amount','admin_user_wallet',
	'admin_add','admin_edit','admin_view','admin_api_settings','admin_commission'))){
		echo $this->Html->link('Users',array('controller' => 'users', 'action' => 'index','admin'=>true),array('class' => 'current'));
	}else{
		echo $this->Html->link('Users',array('controller' => 'users', 'action' => 'index','admin'=>true));
	}
	?>
    
     	 <ul class="nav_submenu submenu" <?php echo $class; ?>>
     	 	
	  		<li><?php echo $this->Html->link('Distributors',array('controller' => 'users', 'action' => 'index',3,'admin'=>true)); ?></li>
	  		<li><?php echo $this->Html->link('Retailers',array('controller' => 'users', 'action' => 'index',4,'admin'=>true)); ?></li>
			<li><?php echo $this->Html->link('Send SMS',array('controller' => 'users', 'action' => 'send_sms','admin'=>true)); ?></li>
		</ul>    
	</li>
	
	  
    <li><?php
	if(in_array(strtolower($this->name),array('recharges','operators')) && in_array(strtolower($this->action),
	array('admin_index','admin_global_apisettings'))){
		//echo $this->Html->link('Recharge',array('controller' => 'recharges', 'action' => 'index','admin'=>true),array('class' => 'current'));
		 echo $this->Html->link('Recharge',array('controller' => 'recharges', 'action' => 'global_apisettings','admin'=>true),array('class' => 'current'));
	}else{
		//echo $this->Html->link('Recharge',array('controller' => 'recharges', 'action' => 'index','admin'=>true));
		 echo $this->Html->link('Recharge',array('controller' => 'recharges', 'action' => 'global_apisettings','admin'=>true));
	}
	?>
     	<ul class="nav_submenu submenu">
			<li><?php echo $this->Html->link('Global Recharge API',array('controller' => 'recharges', 'action' => 'global_apisettings','admin'=>true));?></li>
            <li><?php echo $this->Html->link('Change Recharge Status',array('controller' => 'recharges', 'action' => 'index','admin'=>true));?></li>
           
        <?php //echo $this->Html->link('Add Mobile Series',array('controller' => 'recharges', 'action' => 'mobile_series_list','admin'=>true));?>
            <li><?php echo $this->Html->link('Add State',array('controller' => 'recharges', 'action' => 'state_list','admin'=>true));?></li>
     <?php //echo $this->Html->link('Amount Range',array('controller' => 'recharges', 'action' => 'amount_range_list','admin'=>true));?>
              <li><?php echo $this->Html->link('SMS Based Recharge',array('controller' => 'recharges', 'action' => 'sms_based_recharge','admin'=>true));?></li>
             <li><?php echo $this->Html->link('Change SMS Recharge Status',array('controller' => 'recharges', 'action' => 'sms_recharge_history','admin'=>true));?></li>
            
        </ul>
	</li>
	
	<li><?php
	if(in_array(strtolower($this->name),array('commission')) && in_array(strtolower($this->action),
	array('admin_global_surcharge_setting','admin_commission_settings'))){
		echo $this->Html->link('Commission',array('controller' => 'commission', 'action' => 'commission_settings','admin'=>true),array('class' => 'current'));
	}else{
		echo $this->Html->link('Commission',array('controller' => 'commission', 'action' => 'commission_settings','admin'=>true));
	}
	?>
      <ul class="nav_submenu submenu">
      	 <li><?php echo $this->Html->link('Commission Settings',array('controller' => 'commission', 'action' => 'commission_settings','admin'=>true));?></li>
         <li><?php echo $this->Html->link('Surcharge Settings',array('controller' => 'commission', 'action' => 'global_surcharge_setting','admin'=>true));?></li>
           <li><?php echo $this->Html->link('Commission',array('controller' => 'commission', 'action' => 'rc_commission','admin'=>true));?>
               <ul class="nav_submenu submenu childs">
                   <li><?php echo $this->Html->link('Recharge Commission',array('controller' => 'commission', 'action' => 'rc_commission','admin'=>true));?></li>
                   <li><?php echo $this->Html->link('MT Commission',array('controller' => 'commission', 'action' => 'mt_commission','admin'=>true));?></li>
                   <li><?php echo $this->Html->link('P2P Charges',array('controller' => 'commission', 'action' => 'p2p_commission','admin'=>true));?></li>
               </ul>
           </li>
            
    <?php //echo $this->Html->link('Commission Packages',array('controller' => 'commission', 'action' => 'commission_package_list','admin'=>true));?>
      </ul>
	</li>
    <li><?php
	if(strtolower($this->name)=='moneytransfers'){
		echo $this->Html->link('Money Transfer',array('controller' => 'moneytransfers', 'action' => 'index','admin'=>true),array('class' => 'current'));
	}else{
		echo $this->Html->link('Money Transfer',array('controller' => 'moneytransfers', 'action' => 'index','admin'=>true));
	}
	?>
        
        <ul class="nav_submenu submenu">
      	
         <li><?php echo $this->Html->link('Service C. Settings',array('controller' => 'moneytransfers', 'action' => 'index','admin'=>true));?></li>
         <li><?php echo $this->Html->link('Transactions',array('controller' => 'moneytransfers', 'action' => 'transactions','admin'=>true));?></li>
       </ul>
	</li>
    
     <li><?php
	if(strtolower($this->name)=='p2p'){
		echo $this->Html->link('P2P Transfer',array('controller' => 'P2P', 'action' => 'p2p_globalCharge','admin'=>true),array('class' => 'current'));
	}else{
		echo $this->Html->link('P2P Transfer',array('controller' => 'P2P', 'action' => 'p2p_globalCharge','admin'=>true));
	}
	?>
     </li>
    
    <li><?php
	if(strtolower($this->name)=='reports'){
		echo $this->Html->link('Reports',array('controller' => 'reports', 'action' => 'recharge_report','admin'=>true),array('class' => 'current'));
	}else{
		echo $this->Html->link('Reports',array('controller' => 'reports', 'action' => 'recharge_report','admin'=>true));
	}
	?>
     <ul class="nav_submenu submenu">
			<!--<li><?php echo $this->Html->link('Recharge Report',array('controller' => 'reports', 'action' => 'index','admin'=>true));?></li>-->
            <li><?php echo $this->Html->link('Recharge Report',array('controller' => 'reports', 'action' => 'recharge_report','admin'=>true));?></li>
            
            <li><?php echo $this->Html->link('SMS Recharge Report',array('controller' => 'reports', 'action' => 'sms_recharge_report','admin'=>true));?></li>
            <li><?php echo $this->Html->link('Longcode Report',array('controller' => 'reports', 'action' => 'long_code_report','admin'=>true));?></li>
            <li><?php echo $this->Html->link('Summary Report',array('controller' => 'reports', 'action' => 'summary_report','admin'=>true));?></li>
            <li><?php echo $this->Html->link('Wallet Log',array('controller' => 'wallet', 'action' => 'wallet_log','admin'=>true));?></li>
            <li><?php echo $this->Html->link('Ledger Report',array('controller' => 'reports', 'action' => 'ledger_report','admin'=>true));?></li>
            <li><?php echo $this->Html->link('Billing Summary',array('controller' => 'reports', 'action' => 'billing_report','admin'=>true));?></li>
               <li><?php echo $this->Html->link('MT Report',array('controller' => 'reports', 'action' => 'mt_report','admin'=>true));?></li>
            <li><?php echo $this->Html->link('P2P Report',array('controller' => 'reports', 'action' => 'p2p_report','admin'=>true));?></li>
            
           <!-- <li class="inactive_menuItems"><?php echo $this->Html->link('API Report',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li class="inactive_menuItems"><?php echo $this->Html->link('Summary Report',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li><?php echo $this->Html->link('Pending Recharge',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li><?php echo $this->Html->link('Update Recharge',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li class="inactive_menuItems"><?php echo $this->Html->link('Longcode Report',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li class="inactive_menuItems"><?php echo $this->Html->link('SMS Report',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li class="inactive_menuItems"><?php echo $this->Html->link('Operator Balance',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li class="inactive_menuItems"><?php echo $this->Html->link('Op. Bal. Inquiry',array('controller' => '#', 'action' => '#','admin'=>true));?></li>-->
		</ul>
	</li>
     
    
  
    <!--<li><?php
	if(in_array(strtolower($this->name),array('wallet')) && in_array(strtolower($this->action),
	array('admin_wallet_log'))){
		echo $this->Html->link('Wallet Log',array('controller' => 'wallet', 'action' => 'wallet_log','admin'=>true),array('class' => 'current'));
	}else{
		echo $this->Html->link('Wallet Log',array('controller' => 'wallet', 'action' => 'wallet_log','admin'=>true));
	}
	?>    
	</li>-->
    
    
    <!--<li class="inactive_menuItems"><?php
	if(strtolower($this->name)=='services'){
		echo $this->Html->link('Services',array('controller' => '#', 'action' => '#','admin'=>true),array('class' => 'current'));
	}else{
		echo $this->Html->link('Services',array('controller' => '#', 'action' => '#','admin'=>true));
	}
	?>
     <ul class="nav_submenu submenu">
			<li><?php echo $this->Html->link('Commission Packages',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li><?php echo $this->Html->link('Mobile Commission',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li><?php echo $this->Html->link('DTH Commission',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li><?php echo $this->Html->link('Data Card Commission',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li><?php echo $this->Html->link('Pospaid Commission',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li><?php echo $this->Html->link('Other Commission',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li><?php echo $this->Html->link('User Commission',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
			
		</ul>
	</li>-->
  
    
    <li><?php
	if(strtolower($this->name)=='manage_customers'){
		echo $this->Html->link('Manage Customer`s Wallet',array('controller' => 'wallet', 'action' => 'credit_debit','admin'=>true),array('class' => 'current'));
	}else{
		echo $this->Html->link('Manage Customer`s Wallet',array('controller' => 'wallet', 'action' => 'credit_debit','admin'=>true));
	}
	?>
     <ul class="nav_submenu submenu">
			
           <!-- <li class="inactive_menuItems"><?php echo $this->Html->link('API Users',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li class="inactive_menuItems"><?php echo $this->Html->link('State Partners',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li class="inactive_menuItems"><?php echo $this->Html->link('Add Customers',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li class="inactive_menuItems"><?php echo $this->Html->link('Transactions',array('controller' => '#', 'action' => '#','admin'=>true));?></li>-->
            <li><?php echo $this->Html->link('Credits/Debits',array('controller' => 'wallet', 'action' => 'credit_debit','admin'=>true));?></li>
           <!-- <li class="inactive_menuItems"><?php echo $this->Html->link('Operator Balance',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li class="inactive_menuItems"><?php echo $this->Html->link('Activation Report',array('controller' => '#', 'action' => '#','admin'=>true));?></li>-->
			
		</ul>
	</li>
   
	
    
    
  <!--------------Support ------------------------->
    
   <li><?php
	if(strtolower($this->name)=='tickets'){
		echo $this->Html->link('Support Center',array('controller' => 'tickets', 'action' => 'index','admin'=>true),array('class' => 'current'));
	}else{
		echo $this->Html->link('Support Center',array('controller' => 'tickets', 'action' => 'index','admin'=>true));
	}
	?>
     <ul class="nav_submenu submenu">
			<li><?php echo $this->Html->link('Browse Tickets',array('controller' => 'tickets', 'action' => 'index','admin'=>true));?></li>
            <li><?php echo $this->Html->link('Payment Requests',array('controller' => 'tickets', 'action' => 'payment_request_list','admin'=>true));?></li>
            <li><?php echo $this->Html->link('Payment History',array('controller' => 'tickets', 'action' => 'payment_history','admin'=>true));?></li>
             <li><?php echo $this->Html->link('Queries',array('controller' => 'contents', 'action' => 'queries','admin'=>true));?></li>
              <li><?php echo $this->Html->link('Extra Added Service Requests',array('controller' => 'tickets', 'action' => 'eas','admin'=>true));?></li>
		</ul>
	</li>
    <!----------Operator Plans------------->
   <?php
	/* if( in_array(strtolower($this->name),array('opeartorplans')) ){
		echo $this->Html->link('Operators Plan',array('controller' => '#', 'action' => '#','admin'=>true),array('class' => 'current'));
	}else{
		echo $this->Html->link('Operators Plan',array('controller' => '#', 'action' => '#','admin'=>true));
	} */
	?>    
	
    
    <li><?php
	if(in_array(strtolower($this->name),array('settings','users')) && in_array(strtolower($this->action),
	array('admin_my_profile'))){
		echo $this->Html->link('Settings',array('controller' => 'users', 'action' => 'my_profile','admin'=>true),array('class' => 'current'));
	}else{
		echo $this->Html->link('Settings',array('controller' => 'users', 'action' => 'my_profile','admin'=>true));
	}
	?>
     <ul class="nav_submenu submenu">
     		<li><?php echo $this->Html->link('My Profile',array('controller' => 'users', 'action' => 'my_profile','admin'=>true));?></li>
                <li><?php echo $this->Html->link('Recharge',array('controller' => 'settings', 'action' => 'recharge_setting','admin'=>true));?></li>
                <li><?php echo $this->Html->link('CMS',array('controller' => 'contents', 'action' => 'index','admin'=>true));?></li>
                <li><?php echo $this->Html->link('Testimonials',array('controller' => 'settings', 'action' => 'list_testimonial','admin'=>true));?></li>
			<!--<li class="inactive_menuItems"><?php echo $this->Html->link('Change Theme',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li class="inactive_menuItems"><?php echo $this->Html->link('Slider Images',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li class="inactive_menuItems"><?php echo $this->Html->link('Alert Options',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li class="inactive_menuItems"><?php echo $this->Html->link('Alert Message Outbox',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li class="inactive_menuItems"><?php echo $this->Html->link('Banners',array('controller' => '#', 'action' => '#','admin'=>true));?></li>
            <li class="inactive_menuItems"><?php echo $this->Html->link('News',array('controller' => '#', 'action' => '#','admin'=>true));?></li>-->
           
		</ul>
	</li>
	<li><?php
  
	if(strtolower($this->name)=='emailtemplates'){
		echo $this->Html->link('Newsletter',array('controller' => 'email_templates', 'action' => 'list_newsletters','admin'=>true),array('class' => 'current'));
	}else{
		echo $this->Html->link('Newsletter',array('controller' => 'email_templates', 'action' => 'list_newsletters','admin'=>true));
	}
	?>
	
		<ul class="nav_submenu submenu">
                    
                    <li><?php
				echo $this->Html->link('List Newsletters',array('controller' => 'email_templates', 'action' => 'list_newsletters','admin'=>true));
			?></li>
                    
                     <li><?php
				echo $this->Html->link('Send Newsletters',array('controller' => 'email_templates', 'action' => 'send_newsletter','admin'=>true));
			?></li>
                    <li><?php
				echo $this->Html->link('NewsLetter Subscribers',array('controller' => 'email_templates', 'action' => 'subscribers','admin'=>true));
			?></li>
			
			<li><?php
				echo $this->Html->link('Email Templates',array('controller' => 'email_templates', 'action' => 'index','admin'=>true));
			?></li>
			
		</ul>
	</li>
    <li><?php
	if( in_array(strtolower($this->name),array('slider')) ){
		echo $this->Html->link('Slider',array('controller' => 'slider', 'action' => 'index','admin'=>true),array('class' => 'current'));
                //echo $this->Html->link('Opeartors Plan',array('controller' => 'opeartorplans', 'action' => 'import','admin'=>true),array('class' => 'current'));
	}else{
            echo $this->Html->link('Slider',array('controller' => 'slider', 'action' => 'index','admin'=>true));
		//echo $this->Html->link('Opeartors Plan',array('controller' => 'opeartorplans', 'action' => 'import','admin'=>true));
	}
	?>    
	</li>
     
      
    
</ul>
</div>
<!--[end]#menu -->


<div style="clear: both"></div>

<div id="middlepart">
<div id="leftcolumn">
<div id="mainbox">
<?php echo $this->Session->flash(); ?>
<?php echo $content_for_layout; ?>

</div>
<!--[end]#mainbox --></div>
<!--[end]#leftcolumn -->
</div>
<!--[end]#middlepart --></div>
<!--[end]#wrapper -->


<div id="footer">
    
<p class="copyright">&copy; Copyright <?php echo date("Y"); ?> All rights reserved <br /></p>
</div>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>