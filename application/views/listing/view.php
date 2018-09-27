<?php /*if ($message = $this->service_message->render()) :?>
<?php echo $message;?>
<?php endif; */?>

<!-- button tool bar section start here -->


  <div class="tableView">
		<?php echo $search_bar;?>
		<?php 
			$uri = $this->uri->segment(1);
			if($uri=='accounting')
			{
				?>
        <form name="<?php echo $this->namespace;?>" id="<?php echo $this->namespace;?>" action="<?php echo site_url($this->uri->segment(1, 'admin').'/add_edit_invoice');?>" method="post">
        <?php
      }
      else
      {
      	?>
      	<form name="<?php echo $this->namespace;?>" id="<?php echo $this->namespace;?>" action="<?php echo site_url($this->uri->segment(1, 'admin').'/'.$this->uri->segment(2, 'index').'/bulk_actions');?>" method="post">
      	<?php
      }
    ?>
		<?php echo $listing;?>				
		</form>	
	</div>	




