<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			 Job
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
								<i class="fa fa-gift"></i> Job Form
							</div>
						</div>
						<div class="portlet-body form">
							<form class="form-horizontal" role="form" method="post" action="">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Job Name</label>
										<div class="col-md-5 <?=(form_error('job_name'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="Job Name" name="job_name"
											 value="<?=($edit['job_name'])?$edit['job_name']:$_POST['job_name'];?>">
											<?php if(form_error('job_name')){?>
												<span class="help-block error red"><?=form_error('job_name');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Job Category</label>
										<div class="col-md-5 <?=(form_error('category'))?'has-error':'';?>">
											<select class="form-control select2_sample1" name="category">
												<option value="">--Select--</option>
												<?php
													$category = get_job_category();
													if($category)
													{
														foreach ($category as $key => $value)
														{
															?>
																<option <?=($edit['job_category']==$value['id'])?"selected":"";?>
																	value="<?=$value['id'];?>"><?=$value['name'];?></option>
															<?php
														}
													}?>
											</select>
											<?php if(form_error('category')){?>
												<span class="help-block error red"><?=form_error('category');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Job Description</label>
										<div class="col-md-9 <?=(form_error('description'))?'has-error':'';?>">
											<textarea type="text" rows="8" class="form-control" placeholder="Job Description" name="description"><?=($edit['description'])?$edit['description']:$_POST['description'];?></textarea>
											<?php if(form_error('description')){?>
												<span class="help-block error red"><?=form_error('description');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Job Date</label>
										<div class="col-md-5 <?=(form_error('job_date'))?'has-error':'';?>">
											<input type="text" class="form-control date-picker" placeholder="Job Date" name="job_date"
											 value="<?=($edit['job_date'])?$edit['job_date']:$_POST['job_date'];?>">
											<?php if(form_error('job_date')){?>
												<span class="help-block error red"><?=form_error('job_date');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Start Time</label>
										<div class="col-md-5 <?=(form_error('start_time'))?'has-error':'';?>">
											<input type="text" class="form-control timepicker" placeholder="Start Time" name="start_time"
											 value="<?=($edit['start_time'])?$edit['start_time']:$_POST['start_time'];?>">
											<?php if(form_error('start_time')){?>
												<span class="help-block error red"><?=form_error('start_time');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">End Time</label>
										<div class="col-md-5 <?=(form_error('end_time'))?'has-error':'';?>">
											<input type="text" class="form-control timepicker" placeholder="End Time" name="end_time"
											 value="<?=($edit['end_time'])?$edit['end_time']:$_POST['end_time'];?>">
											<?php if(form_error('end_time')){?>
												<span class="help-block error red"><?=form_error('end_time');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Payment</label>
										<div class="col-md-2 <?=(form_error('amount'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="Amount" name="amount"
											 value="<?=($edit['amount'])?$edit['amount']:$_POST['amount'];?>">
											<?php if(form_error('amount')){?>
												<span class="help-block error red"><?=form_error('amount');?></span>
											<?php }?>
										</div>
										<div class="col-md-3 <?=(form_error('recurring'))?'has-error':'';?>">
											<select class="form-control" name="recurring">
												<option value="">--Select--</option>
												<option <?=($edit['recurring']=="Lump Sum")?"selected":"";?> value="Lump Sum">Lump Sum</option>
												<option <?=($edit['recurring']=="Hourly Wage")?"selected":"";?> value="Hourly Wage">Hourly Wage</option>
												<option <?=($edit['recurring']=="Daily")?"selected":"";?> value="Daily">Daily</option>
												<option <?=($edit['recurring']=="Weekly")?"selected":"";?> value="Weekly">Weekly</option>
												<option <?=($edit['recurring']=="Bi-Weekly")?"selected":"";?> value="Bi-Weekly">Bi-Weekly</option>
												<option <?=($edit['recurring']=="Monthly")?"selected":"";?> value="Monthly">Monthly</option>
											</select>
											<?php if(form_error('recurring')){?>
												<span class="help-block error red"><?=form_error('recurring');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Address</label>
										<div class="col-md-9 <?=(form_error('address'))?'has-error':'';?>">
											<textarea type="text" class="form-control" rows="3" placeholder="Address" name="address"><?=($edit['address'])?$edit['address']:$_POST['address'];?></textarea>
											<?php if(form_error('address')){?>
												<span class="help-block error red"><?=form_error('address');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Logo</label>
										<div class="col-md-9 <?=(form_error('address'))?'has-error':'';?>">
											<input type="file" name="logo" checked="form-control">
											<?php if(form_error('logo')){?>
												<span class="help-block error red"><?=form_error('logo');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Would you like to include your address in this post?</label>
										<div class="col-md-9 <?=(form_error('address_include'))?'has-error':'';?>">
											<input type="radio" <?=($edit['address_include']=="Yes")?"checked":"";?> name="address_include" value="Yes">Yes
											<input type="radio" <?=($edit['address_include']=="No")?"checked":"";?> name="address_include" value="No">No
										</div>
										<?php if(form_error('address_include')){?>
												<span class="help-block error red"><?=form_error('address_include');?></span>
											<?php }?>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green">Submit</button>
											<a href="<?=site_url('jobs/job_list');?>" class="btn default">Cancel</a>
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