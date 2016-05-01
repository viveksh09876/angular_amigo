<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
	
	
		<li><?php echo $this->Html->link(__('Back to Templates', true), array('action' => 'index')); ?> </li>
	</ul>
</div>

<div class="customers view">
	<h2><?php echo __('Template');?>: <?php echo $Template['EmailTemplate']['template_name'];?></h2>
	<table>
	
		<tr><th colspan="4">Restaurant Info</th></tr>
		<tr>
		  <td><strong>Template Name</strong></td>
        <td><?php echo $Template['EmailTemplate']['template_name'];?></td>	
		<td><strong>Template key</strong></td>
        <td><?php	echo $Template['EmailTemplate']['template_key'];?></td>
        </tr>
       	<tr>
        <td><strong>From Name</strong></td>
        <td><?php echo $Template['EmailTemplate']['from_name'];?></td>	
		<td><strong>From Email</strong></td>
        <td><?php	echo $Template['EmailTemplate']['from_email'];?></td>
        </tr>
        <tr>
        <td><strong>Email subject</strong></td>
        <td><?php echo $Template['EmailTemplate']['email_subject'];?></td>	
		<td><strong>Email body</strong></td>
        <td><?php	echo $Template['EmailTemplate']['email_body'];?></td>
        </tr>
      
		<tr>
        <td><strong>Added Date</strong></td><td><?php echo date("d M Y h:i A",strtotime($Template['EmailTemplate']['template_added_date']));  ?></td>

		<td><strong>Modified Date</strong></td><td><?php if($Template['EmailTemplate']['template_modified_date']!='') echo date("d M Y h:i A",strtotime($Template['EmailTemplate']['template_modified_date']));  ?></td>
		</tr>

        <tr>
        <td><strong>Status</strong></td>
        <td><?php	echo $Template['EmailTemplate']['template_status'];?></td>
		
		</tr>
	</table>
