<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		 Email Notifications
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
							<i class="fa fa-gift"></i> Email Notifications Form
						</div>
					</div>
					<div class="portlet-body form">
						<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Employees</label>
									<div class="col-md-9 <?=(form_error('employee'))?'has-error':'';?>">
										<select name="employees[]" data-placeholder="Select Employees" id="select2_sample1" class="form-control select2_sample1" multiple>
											<?php
												$users = get_users('3');
												foreach ($users as $key => $value)
												{
													?>
														<option value="<?=$value['email'];?>"><?=$value['firstname'];?></option>
													<?php
												}
											?>
										</select>
										<?php if(form_error('employee')){?>
											<span class="help-block error red"><?=form_error('employee');?></span>
										<?php }?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Subject</label>
									<div class="col-md-9 <?=(form_error('subject'))?'has-error':'';?>">
										<input type="text" placeholder="Subject" name="subject" class="form-control"
										value="<?=($edit['account_number'])?$edit['subject']:$_POST['subject'];?>">
										<?php if(form_error('subject')){?>
											<span class="help-block error red"><?=form_error('subject');?></span>
										<?php }?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Message</label>
									<div class="col-md-9 <?=(form_error('message'))?'has-error':'';?>">
										<textarea name="message" class="form-control wysihtml5" rows="10"></textarea>
										<?php if(form_error('message')){?>
											<span class="help-block error red"><?=form_error('message');?></span>
										<?php }?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Attachment</label>
									<div class="col-md-9">
										<input type="file" name="attachment[]" class="form-control" multiple="">
										<span class="help-block">Hold Ctrl button attach multiple files.</span>
									</div>
								</div>
							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn green">Send</button>
										<a href="<?=site_url('email_notifications');?>" class="btn default">Cancel</a>
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