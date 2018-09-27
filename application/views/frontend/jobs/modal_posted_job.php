<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">JOB ID #<?=$job['job_id'];?></h4>
		</div>
		<div class="modal-body" style="max-height: 450px;overflow: auto;">
			<h2>Job Details</h2>
			<div class="row">
			 	<div class="col-md-4">
			 		<label><b>Job Name</b> : <?=$job['job_name'];?></label>
			 	</div>
			 	<div class="col-md-4">
			 		<label><b>Job Category</b> : <?=$job['category'];?></label>
			 	</div>
			 	<div class="col-md-4">
			 		<label><b>Job Date</b> : <?=displayData($job['job_date'],'date');?></label>
			 	</div>
			</div><br>
			<div class="row">
			 	<div class="col-md-12">
			 		<label><b>Job Description</b> : <?=$job['description'];?></label>
			 	</div>
			</div><br>
			<div class="row">
			 	<div class="col-md-3">
			 		<label><b>Job Start Time</b> : <?=$job['start_time'];?></label>
			 	</div>
			 	<div class="col-md-3">
			 		<label><b>Job End Time</b> : <?=$job['end_time'];?></label>
			 	</div>
			 	<div class="col-md-3">
			 		<label><b>Amount</b> : <?=displayData($job['amount'],'money')." (".$job['recurring'].")";?></label>
			 	</div>
			 	<div class="col-md-3">
			 		<label><b>Address</b> : <?=$job['address'];?></label>
			 	</div>
			</div>
			<?php if($this->session->userdata('user_data')['role']!='6'){?>
			<h2>Employer Details</h2>
			<div class="row">
			 	<div class="col-md-4">
			 		<label><b>Employer Name</b> : <?=$job['epl_name'];?></label>
			 	</div>
			 	<div class="col-md-8">
			 		<label><b>Address</b> : <?=$job['epl_address1']." ,".$job['epl_address2']." ,".$job['epl_city']." ,".$job['epl_state']." ,".$job['epl_zipcode'];?></label>
			 	</div>
			 	<div class="col-md-6">
			 		<label><b>Employer Email</b> : <?=$job['epl_email'];?></label>
			 	</div>			 	
			</div>
			<?php }?>
			<h2>Employee Details</h2>
			<div class="row">
			 	<div class="col-md-4">
			 		<label><b>Employee Name</b> : <?=$job['emp_name'];?></label>
			 	</div>
			 	<div class="col-md-8">
			 		<label><b>Address</b> : <?=$job['emp_address1']." ,".$job['emp_address2']." ,".$job['emp_city']." ,".$job['emp_state']." ,".$job['emp_zipcode'];?></label>
			 	</div>
			 	<div class="col-md-6">
			 		<label><b>Employee Email</b> : <?=$job['emp_email'];?></label>
			 	</div>			 	
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>