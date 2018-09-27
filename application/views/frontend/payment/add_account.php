<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			 Checking Account
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
								<i class="fa fa-gift"></i> Checking Account Form
							</div>
						</div>
						<div class="portlet-body form">
							<form class="form-horizontal" role="form" method="post" action="">
								<div class="form-body">
									<?php 
									if($this->session->userdata('user_data')['role']!="6"){
										$users = get_users('6');
										?>
									<div class="form-group">
										<label class="col-md-3 control-label">Employer</label>
										<div class="col-md-5 <?=(form_error('job_name'))?'has-error':'';?>">
											<select class="form-control" name="employer_id">
												<option value="">--Select--</option>
												<?php
													if($users)
													{
														foreach ($users as $value)
														{
															?>
																<option <?=($edit['employer_id']==$value['id'])?"selected":"";?>
																	 value="<?=$value['id'];?>"><?=$value['firstname'];?></option>
															<?php
														}
													}
												?>
											</select>
										</div>
									</div>
									<?php }?>
									<div class="form-group">
										<label class="col-md-3 control-label">Name on Account</label>
										<div class="col-md-5 <?=(form_error('name'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="Name on Account" name="name"
											 value="<?=($edit['name'])?$edit['name']:$_POST['name'];?>">
											<?php if(form_error('name')){?>
												<span class="help-block error red"><?=form_error('name');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Bank Routing Number</label>
										<div class="col-md-5 <?=(form_error('routing_number'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="Bank Routing Number" name="routing_number"
											value="<?=($edit['routing_number'])?$edit['routing_number']:$_POST['routing_number'];?>">
											<?php if(form_error('routing_number')){?>
												<span class="help-block error red"><?=form_error('routing_number');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Checking Account Number</label>
										<div class="col-md-5 <?=(form_error('acc_number'))?'has-error':'';?>">
											<input type="text" placeholder="Checking Account Number" name="acc_number" class="form-control"
											value="<?=($edit['account_number'])?$edit['account_number']:$_POST['acc_number'];?>">
											<?php if(form_error('acc_number')){?>
												<span class="help-block error red"><?=form_error('acc_number');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Re-enter Checking Account Number</label>
										<div class="col-md-5 <?=(form_error('re_acc_number'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="Re-enter Checking Account Number" name="re_acc_number"
											value="<?=($edit['account_number'])?$edit['account_number']:$_POST['re_acc_number'];?>">
											<?php if(form_error('re_acc_number')){?>
												<span class="help-block error red"><?=form_error('re_acc_number');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Driver License Number</label>
										<div class="col-md-5 <?=(form_error('driver_license'))?'has-error':'';?>">
											<input type="text" name="driver_license" class="form-control" placeholder="Driver License Number"
											value="<?=($edit['license_number'])?$edit['license_number']:$_POST['driver_license'];?>">
											<?php if(form_error('driver_license')){?>
												<span class="help-block error red"><?=form_error('driver_license');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">State</label>
										<div class="col-md-5 <?=(form_error('state'))?'has-error':'';?>">
											<select class="form-control" name="state">
												<option value="">--Select--</option>
												<option <?=($edit['state']=="Texas")?"selected":"";?> value="Texas">Texas</option>
												<option <?=($edit['state']=="Florida")?"selected":"";?> value="Florida">Florida</option>
												<option <?=($edit['state']=="Georgia")?"selected":"";?> value="Georgia">Georgia</option>
												<option <?=($edit['state']=="North Carolina")?"selected":"";?> value="North Carolina">North Carolina</option>
											</select>
											<?php if(form_error('state')){?>
												<span class="help-block error red"><?=form_error('state');?></span>
											<?php }?>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green">Submit</button>
											<a href="<?=site_url('payment/checking_account');?>" class="btn default">Cancel</a>
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