<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			 Credit or Debit Card
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
								<i class="fa fa-gift"></i> Credit or Debit Card Form
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
										<label class="col-md-3 control-label">Card Holder Name</label>
										<div class="col-md-5 <?=(form_error('name'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="Card Holder Name" name="name"
											 value="<?=($edit['name'])?$edit['name']:$_POST['name'];?>">
											<?php if(form_error('name')){?>
												<span class="help-block error red"><?=form_error('name');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Card Number</label>
										<div class="col-md-5 <?=(form_error('card_number'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="Card Number" name="card_number"
											value="<?=($edit['card_number'])?$edit['card_number']:$_POST['card_number'];?>" maxlength="16">
											<?php if(form_error('card_number')){?>
												<span class="help-block error red"><?=form_error('card_number');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Expiry Date</label>
										<div class="col-md-2 <?=(form_error('exp_month'))?'has-error':'';?>">
											<select class="form-control" name="exp_month">
												<option value="">--Select--</option>
												<option <?=($edit['exp_month']=="01" || $_POST['exp_month']=="01")?"selected":"";?> value="01">01</option>
												<option <?=($edit['exp_month']=="02" || $_POST['exp_month']=="02")?"selected":"";?> value="02">02</option>
												<option <?=($edit['exp_month']=="03" || $_POST['exp_month']=="03")?"selected":"";?> value="03">03</option>
												<option <?=($edit['exp_month']=="04" || $_POST['exp_month']=="04")?"selected":"";?> value="04">04</option>
												<option <?=($edit['exp_month']=="05" || $_POST['exp_month']=="05")?"selected":"";?> value="05">05</option>
												<option <?=($edit['exp_month']=="06" || $_POST['exp_month']=="06")?"selected":"";?> value="06">06</option>
												<option <?=($edit['exp_month']=="07" || $_POST['exp_month']=="07")?"selected":"";?> value="07">07</option>
												<option <?=($edit['exp_month']=="08" || $_POST['exp_month']=="08")?"selected":"";?> value="08">08</option>
												<option <?=($edit['exp_month']=="09" || $_POST['exp_month']=="09")?"selected":"";?> value="09">09</option>
												<option <?=($edit['exp_month']=="10" || $_POST['exp_month']=="10")?"selected":"";?> value="10">10</option>
												<option <?=($edit['exp_month']=="11" || $_POST['exp_month']=="11")?"selected":"";?> value="11">11</option>
												<option <?=($edit['exp_month']=="12" || $_POST['exp_month']=="12")?"selected":"";?> value="12">12</option>
											</select>
											<?php if(form_error('exp_month')){?>
												<span class="help-block error red"><?=form_error('exp_month');?></span>
											<?php }?>
										</div>
										<div class="col-md-3 <?=(form_error('exp_year'))?'has-error':'';?>">
											<select class="form-control" name="exp_year">
												<option value="">--Select--</option>
												<?php
												$year = date("Y");
												$year1 = date("Y",strtotime("+20 years"));
												for ($i=$year; $i < $year1; $i++)
												{ 
													?>
														<option <?=($edit['exp_year']==$i || $_POST['exp_year']==$i)?"selected":"";?> value="<?=$i;?>">
															<?=$i;?>
														</option>
													<?php
												}
												?>												
											</select>
											<?php if(form_error('exp_year')){?>
												<span class="help-block error red"><?=form_error('exp_year');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">CVV</label>
										<div class="col-md-5 <?=(form_error('cvv'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="CVV" name="cvv"
											value="<?=($edit['cvv'])?$edit['cvv']:$_POST['cvv'];?>">
											<?php if(form_error('cvv')){?>
												<span class="help-block error red"><?=form_error('cvv');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Card Type</label>
										<div class="col-md-5 <?=(form_error('card_type'))?'has-error':'';?>">
											<select class="form-control" name="card_type">
												<option value="">--Select--</option>
												<option <?=($edit['card_type']=="Visa" || $_POST['card_type']=="Visa")?"selected":"";?> value="Visa">Visa</option>
												<option <?=($edit['card_type']=="Mastercard" || $_POST['card_type']=="Mastercard")?"selected":"";?> value="Mastercard">Mastercard</option>
												<option <?=($edit['card_type']=="Maestro" || $_POST['card_type']=="Maestro")?"selected":"";?> value="Maestro">Maestro</option>
												<option <?=($edit['card_type']=="Amex" || $_POST['card_type']=="Amex")?"selected":"";?> value="Amex">Amex</option>
												<option <?=($edit['card_type']=="Discover" || $_POST['card_type']=="Discover")?"selected":"";?> value="Discover">Discover</option>
											</select>
											<?php if(form_error('card_type')){?>
												<span class="help-block error red"><?=form_error('card_type');?></span>
											<?php }?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Make this card default?</label>
										<div class="col-md-5">
											<input type="checkbox" name="default_card" <?=($edit['default_card']=="1" || $_POST['default_card']=="1")?"checked":"";?> value="1">
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green">Submit</button>
											<a href="<?=site_url('payment/credit_card');?>" class="btn default">Cancel</a>
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