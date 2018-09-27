<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			 Paypal
			</h3>
			<div class="page-bar">
				 <?php echo set_breadcrumb(); ?>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<?php display_flashmsg($this->session->flashdata()); ?>
			<div class="row">
				<div class="col-md-12 ">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Paypal Form
							</div>
						</div>
						<div class="portlet-body form">
							<form class="form-horizontal" role="form" method="post" action="">
								<input type="hidden" name="edit_id" value="<?=isset($edit['id'])?$edit['id']:"";?>">
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
										<label class="col-md-3 control-label">Paypal Email-ID</label>
										<div class="col-md-5 <?=(form_error('email'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="Paypal Email-ID" name="email"
											 value="<?=($edit['email_id'])?$edit['email_id']:$_POST['email'];?>">
											<?php if(form_error('email')){?>
												<span class="help-block error red"><?=form_error('email');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">API Key</label>
										<div class="col-md-5 <?=(form_error('api_key'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="API Key" name="api_key"
											value="<?=($edit['api_key'])?$edit['api_key']:$_POST['api_key'];?>">
											<?php if(form_error('api_key')){?>
												<span class="help-block error red"><?=form_error('api_key');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">API Signature</label>
										<div class="col-md-5 <?=(form_error('api_signature'))?'has-error':'';?>">
											<input type="text" placeholder="API Signature" name="api_signature" class="form-control"
											value="<?=($edit['api_signature'])?$edit['api_signature']:$_POST['api_signature'];?>">
											<?php if(form_error('api_signature')){?>
												<span class="help-block error red"><?=form_error('api_signature');?></span>
											<?php }?>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green">Submit</button>
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