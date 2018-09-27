<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		 Roles
		</h3>
		<div class="page-bar">
			 <?php echo set_breadcrumb(); ?>
		</div>
		<div class="blue-mat"></div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<?php display_flashmsg($this->session->flashdata()); ?>
		<div class="row">
			<div class="col-md-12 ">
				<!-- BEGIN SAMPLE FORM PORTLET-->
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i> Role Form
						</div>
					</div>
					<div class="portlet-body form">
						<form class="form-horizontal" role="form" method="post" action="">
							<div class="form-body">
								<div class="form-group <?=(form_error('name'))?'has-error':'';?>">
									<label class="col-md-3 control-label">Name</label>
									<div class="col-md-5">
										<input type="text" class="form-control" placeholder="Role Name" name="name"
										 value="<?=($edit['role'])?$edit['role']:$_POST['name'];?>">
										<?php if(form_error('name')){?>
											<span class="help-block error red"><?=form_error('name');?></span>
										<?php }?>
									</div>
								</div>
								<?php
									$menu = json_decode($edit['menu_id']);
									$access = json_decode($edit['action_id']);
								?>
								<div class="form-group <?=(form_error('menu'))?'has-error':'';?>">
									<label class="col-md-3 control-label">Menu</label>
									<div class="col-md-4 padding-zero">
										<ul class="menu-ul">
											<li>
												<label>
													<input type="checkbox" value="1" name="menu[employers]" <?=($menu->employers=="1")?"checked":"";?>>Employers
												</label>
											</li>
											<li>
												<label>
													<input type="checkbox" value="1" name="menu[employees]" <?=($menu->employees=="1")?"checked":"";?>>Employees
												</label>
											</li>
											<li>
												<label>
													<input type="checkbox" value="1" name="menu[roles]" <?=($menu->roles=="1")?"checked":"";?>>Roles
												</label>
											</li>
											<li>
												<label>
													<input type="checkbox" value="1" name="menu[payment_history]" <?=($menu->payment_history=="1")?"checked":"";?>>Payment History
												</label>
											</li>
											<li>
												<label>
													<input type="checkbox" value="1" name="menu[reports]" <?=($menu->reports=="1")?"checked":"";?>>Reports
												</label>
											</li>
											<li>
												<label>
													<input type="checkbox" value="1" name="menu[email]" <?=($menu->email=="1")?"checked":"";?>>Email Notifications
												</label>
											</li>
										</ul>
									</div>
									<div class="col-md-5 padding-zero">
										<ul class="menu-ul right-menu">
											<li>
												<label>
													<input type="checkbox" value="1" class="mainmenu"  name="menu[jobs]" <?=($menu->jobs=="1")?"checked":"";?>>Jobs
												</label>
												<ul>
													<li><label><input type="checkbox" value="1" class="submenu" name="menu[list]" <?=($menu->list=="1")?"checked":"";?>>Jobs List</label></li>
													<li><label><input type="checkbox" value="1" class="submenu" name="menu[posted]" <?=($menu->posted=="1")?"checked":"";?>>Posted Jobs</label></li>
													<li><label><input type="checkbox" value="1" class="submenu" name="menu[category]" <?=($menu->category=="1")?"checked":"";?>>Category</label></li>
												</ul>
											</li>
											<li>
												<label>
													<input type="checkbox" value="1" class="mainmenu" name="menu[payment_methods]" <?=($menu->payment_methods=="1")?"checked":"";?>>Payment Methods
												</label>
												<ul>
													<li><label><input type="checkbox" class="submenu" value="1" name="menu[card]" <?=($menu->card=="1")?"checked":"";?>>Credit Card or Debit Card</label></li>
													<li><label><input type="checkbox" class="submenu" value="1" name="menu[account]" <?=($menu->account=="1")?"checked":"";?>>Checking Account</label></li>
													<li><label><input type="checkbox" class="submenu" value="1" name="menu[paypal]" <?=($menu->paypal=="1")?"checked":"";?>>Paypal</label></li>
												</ul>
											</li>
										</ul>
									</div>
									<?php if(form_error('menu[]')){?>
										<span class="col-md-9 pull-right help-block error red"><?=form_error('menu[]');?></span>
									<?php }?>
								</div>
								<div class="form-group  <?=(form_error('access'))?'has-error':'';?>">
									<label class="col-md-3 control-label">Access Level</label>
									<div class="col-md-9 padding-zero">
										<label class="col-md-2">
											<input type="checkbox" value="1" name="access[create]" <?=($access->create=="1")?"checked":"";?>>Create
										</label>
										<label class="col-md-2">
											<input type="checkbox" value="1" name="access[edit]" <?=($access->edit=="1")?"checked":"";?>>Edit
										</label>
										<label class="col-md-2">
											<input type="checkbox" value="1" name="access[view]" <?=($access->view=="1")?"checked":"";?>>View
										</label>
										<label class="col-md-2">
											<input type="checkbox" value="1" name="access[delete]" <?=($access->delete=="1")?"checked":"";?>>Delete
										</label>
										<!-- ?<label><input type="checkbox" name=""></label> -->
									</div>
										<?php if(form_error('access[]')){?>
											<span class="col-md-8 help-block error red"><?=form_error('access[]');?></span>
										<?php }?>
								</div>								
								<div class="form-group">
									<label class="col-md-3 control-label">Active</label>
									<div class="col-md-5">
										<input type="checkbox" name="active" class="" value="Active" <?=($edit['status']=="Active")?"checked":"";?>>
									</div>
								</div>
							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn green">Submit</button>
										<a href="<?=site_url('roles');?>" class="btn default">Cancel</a>
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