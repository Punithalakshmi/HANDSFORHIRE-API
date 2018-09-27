<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			 Employee
			</h3>
			<div class="page-bar">
				 <?php echo set_breadcrumb(); ?>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12 ">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Employee Form
							</div>
						</div>
						<div class="portlet-body form">
							<form class="form-horizontal" role="form" method="post" action="">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">First Name</label>
										<div class="col-md-5 <?=(form_error('firstname'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="First Name" name="firstname"
											 value="<?=($edit['firstname'])?$edit['firstname']:$_POST['firstname'];?>">
											<?php if(form_error('firstname')){?>
												<span class="help-block error red"><?=form_error('firstname');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Last Name</label>
										<div class="col-md-5 <?=(form_error('lastname'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="Last Name" name="lastname"
											value="<?=($edit['lastname'])?$edit['lastname']:$_POST['lastname'];?>">
											<?php if(form_error('lastname')){?>
												<span class="help-block error red"><?=form_error('lastname');?></span>
											<?php }?>
										</div>
									</div>
									<?php
										$address1 = ($edit['address'])?explode(" ",$edit['address']):$_POST['address_1'];
										$address2 = ($edit['address'])?explode(" ",$edit['address']):$_POST['address_2'];
									?>
									<div class="form-group">
										<label class="col-md-3 control-label">Address 1</label>
										<div class="col-md-5 <?=(form_error('address_1'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="Street Address Line 1" name="address_1"
											value="<?=($address1[0])?$address1[0]:$address1;?>">
											<?php if(form_error('address_1')){?>
												<span class="help-block error red"><?=form_error('address_1');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Address 2</label>
										<div class="col-md-5">
											<input type="text" class="form-control" placeholder="Street Address Line 2" name="address_2"
											value="<?=($address2[1])?$address2[1]:$address2;?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">City</label>
										<div class="col-md-5 <?=(form_error('city'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="City" name="city"
											value="<?=($edit['city'])?$edit['city']:$_POST['city'];?>">
											<?php if(form_error('city')){?>
												<span class="help-block error red"><?=form_error('city');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">State</label>
										<div class="col-md-5 <?=(form_error('state'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="State" name="state"
											value="<?=($edit['state'])?$edit['state']:$_POST['state'];?>">
											<?php if(form_error('state')){?>
												<span class="help-block error red"><?=form_error('state');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Zipcode</label>
										<div class="col-md-5 <?=(form_error('zipcode'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="Zipcode" name="zipcode"
											value="<?=($edit['zipcode'])?$edit['zipcode']:$_POST['zipcode'];?>">
											<?php if(form_error('zipcode')){?>
												<span class="help-block error red"><?=form_error('zipcode');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Email</label>
										<div class="col-md-5 <?=(form_error('email'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="Email" name="email"
											value="<?=($edit['email'])?$edit['email']:$_POST['email'];?>">
											<?php if(form_error('email')){?>
												<span class="help-block error red"><?=form_error('email');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Username</label>
										<div class="col-md-5 <?=(form_error('username'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="Username" name="username"
											value="<?=($edit['username'])?$edit['username']:$_POST['username'];?>">
											<?php if(form_error('username')){?>
												<span class="help-block error red"><?=form_error('username');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Password</label>
										<div class="col-md-5 <?=(form_error('password'))?'has-error':'';?>">
											<input type="password" class="form-control" placeholder="Password" name="password"
											value="<?=isset($_POST['password'])?$_POST['password']:"";?>">
											<?php if(form_error('password')){?>
												<span class="help-block error red"><?=form_error('password');?></span>
											<?php }?>
										</div>
										<input type="hidden" name="usertype" value="<?=($edit['usertype'])?$edit['usertype']:"";?>">
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green">Submit</button>
											<a href="<?=site_url('user/employees');?>" class="btn default">Cancel</a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT -->
		</div>
	</div>