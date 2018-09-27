<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			 Category
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
								<i class="fa fa-gift"></i> Category Form
							</div>
						</div>
						<div class="portlet-body form">
							<form class="form-horizontal" role="form" method="post" action="">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Name</label>
										<div class="col-md-5 <?=(form_error('name'))?'has-error':'';?>">
											<input type="text" class="form-control" placeholder="Category Name" name="name"
											 value="<?=($edit['name'])?$edit['name']:$_POST['name'];?>">
											<?php if(form_error('name')){?>
												<span class="help-block error red"><?=form_error('name');?></span>
											<?php }?>
										</div>
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
											<a href="<?=site_url('jobs/category');?>" class="btn default">Cancel</a>
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