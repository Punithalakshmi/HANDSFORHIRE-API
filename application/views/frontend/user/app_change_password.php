<div class="menu-toggler sidebar-toggler">
</div>

<div class="logo">
	<h1 style="color: white;">HandzForHire</h1>
</div>

<div class="content">
	<form class="login-form" action="<?=site_url('auth/changepassword');?>" method="post">
		<h3 class="form-title">Forget Password</h3>
		<?php
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
        <input type="hidden" name="id" value="<?php echo (isset($_GET['id']))?$_GET['id']:""; ?>" />
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
