<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		 Credit or Debit Cards
		</h3>
		<div class="page-bar">
			 <?php echo set_breadcrumb(); ?>
		</div>
		<div class="blue-mat"></div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<?php display_flashmsg($this->session->flashdata()); ?>
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-credit-card"></i>Credit or Debit Cards
						</div>
					</div>
					<div class="portlet-body">
						<div class="table-toolbar">
							<div class="row">
								<?=$grid;?>
							</div>
						</div>
					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>
		<!-- END PAGE CONTENT -->
	</div>
</div>