	<div class="page-content-wrapper">
		<div class="page-content">
			<h3 class="page-title">
				Profile
			</h3>
			<div class="page-bar">
				<?php echo set_breadcrumb(); ?>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row margin-top-20">
				<div class="col-md-12">
					<!-- BEGIN PROFILE SIDEBAR -->
					<div class="profile-sidebar">
						<!-- PORTLET MAIN -->
						<div class="portlet light profile-sidebar-portlet">
							<!-- SIDEBAR USERPIC -->
							<div class="profile-userpic">
								<img src="<?=base_url();?>assets/img/photo3.jpg" class="img-responsive" alt="">
							</div>
							<?php
								$profile = get_user_profile();
							?>
							<div class="profile-usertitle">
								<div class="profile-usertitle-name">
									 <?=$profile['firstname'];?>
								</div>
								<div class="profile-usertitle-job">
									 Admin
								</div>
							</div>
						</div>
					</div>
					<div class="profile-content">
						<div class="row">
							<div class="col-md-12">
								<div class="portlet light">
									<div class="portlet-title tabbable-line">
										<div class="caption caption-md">
											<i class="icon-globe theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
										</div>
									</div>
									<div class="portlet-body">
										<form role="form" action="" method="post">
											<div class="form-group <?=(form_error('firstname'))?'has-error':'';?>">
												<label class="control-label">First Name</label>
												<input type="text" placeholder="First Name" name="firstname" class="form-control" value="<?=$profile['firstname'];?>">
												<?php if(form_error('firstname')){?>
													<span class="help-block error red"><?=form_error('firstname');?></span>
												<?php }?>
											</div>
											<div class="form-group <?=(form_error('lastname'))?'has-error':'';?>">
												<label class="control-label">Last Name</label>
												<input type="text" placeholder="Last Name" name="lastname" class="form-control" value="<?=$profile['lastname'];?>">
												<?php if(form_error('lastname')){?>
													<span class="help-block error red"><?=form_error('lastname');?></span>
												<?php }?>
											</div>
											<div class="form-group <?=(form_error('email'))?'has-error':'';?>">
												<label class="control-label">Email</label>
												<input type="text" placeholder="Email" name="email" class="form-control" value="<?=$profile['email'];?>">
												<?php if(form_error('email')){?>
													<span class="help-block error red"><?=form_error('email');?></span>
												<?php }?>
											</div>
											<div class="form-group">
												<label class="control-label">Password</label>
												<input type="text" placeholder="Password" name="password" class="form-control" value="">
											</div>

											<div class="margiv-top-10">
												<button type="submit" class="btn green-haze">Save Changes </button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END PROFILE CONTENT -->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>