<div class="menu-toggler sidebar-toggler">
</div>

<div class="logo">
	<h1 style="color: white;">HandzForHire</h1>
</div>

<div class="content">
	<form class="login-form" action="<?=site_url('user/changepassword');?>" method="post">
		<h3 class="form-title">Forget Password</h3>
		<?php
		if($this->session->flashdata('log_fail'))
		{
			?>
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?=$this->session->flashdata('log_fail');?>
			</div>
			<?php
		}
		if(validation_errors())
		{
			?>
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?=validation_errors();?>
			</div>
			<?php
		}
		?>

		<div class="form-group">
			<label class="control-label">New Password</label>
			<input class="form-control" type="password" autocomplete="off" placeholder="Password" name="new_password"/>
		</div>
		<div class="form-group">
			<label class="control-label">Confrim Password</label>
			<input class="form-control" type="password" autocomplete="off" placeholder="Password" name="confrim_password"/>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-success uppercase">Change Password</button>		
		</div>
	</form>
</div>
