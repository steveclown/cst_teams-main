<div class="portlet-body form">
	<div class="form-body">
			<h3 class="form-section">Personal Data</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label">Employee Code</label>
						<input type="text" name="employee_code" id="employee_code" value="<?php echo $hroemployeedata['employee_code'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Employee Name<span class="required">*</span></label>
						<input type="text" name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Nick Name</label>
						<input type="text" name="employee_nick_name" id="employee_nick_name" value="<?php echo $hroemployeedata['employee_nick_name'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<!--/row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Gender</label>
						<input type="text" name="employee_gender" id="employee_gender" value="<?php echo $gender[($hroemployeedata['employee_gender'])];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Date of Birth<span class="required">*</span></label>
						<input class="form-control" type="text" name="date_of_birth" id="date_of_birth" value="<?php echo tgltoview($hroemployeedata['date_of_birth']);?>" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<!--/row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Place Of Birth</label>
						<input type="text" name="place_of_birth" id="place_of_birth" value="<?php echo $hroemployeedata['place_of_birth'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Religion</label>
						<input type="text" name="employee_religion" id="employee_religion" value="<?php echo $religion[($hroemployeedata['employee_religion'])];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<!--/row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Blood Type</label>
						<input type="text" name="employee_blood_type" id="employee_blood_type" value="<?php echo $bloodtype[($hroemployeedata['employee_blood_type'])];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Picture</label><br>
						<?php
						echo "<img src='".base_url().$path.$hroemployeedata['employee_picture']."' height='150' width='150'>";
						?>
					</div>
				</div>
				<!--/span-->
			</div>
			<!--/row-->
			<h3 class="form-section">Family</h3>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Marital Status</label>
							<input type="text" name="marital_status_id" id="marital_status_id" value="<?php echo $this->main_model->getMaritalStatusName($hroemployeedata['marital_status_id']);?>" class="form-control" readonly>

					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Heir Name</label>
						<input type="text" name="employee_heir_name" id="employee_heir_name" value="<?php echo $hroemployeedata['employee_heir_name'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<!--/row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Heir Occupation</label>
						<input type="text" name="employee_heir_occupation" id="employee_heir_occupation" value="<?php echo $hroemployeedata['employee_heir_occupation'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<!--/row-->
			<h3 class="form-section">Current Address</h3>
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-group">
						<label>Address</label>
						<input type="text" name="employee_address" id="employee_address" value="<?php echo $hroemployeedata['employee_address'];?>" class="form-control" readonly>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>City</label>
						<input type="text" name="employee_city" id="employee_city" value="<?php echo $hroemployeedata['employee_city'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label>Zip Code</label>
						<input type="text" name="employee_zip_code" id="employee_zip_code" value="<?php echo $hroemployeedata['employee_zip_code'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<!--/row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>RT</label>
						<input type="text" name="employee_rt" id="employee_rt" value="<?php echo $hroemployeedata['employee_rt'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label>Kelurahan</label>
						<input type="text" name="employee_kelurahan" id="employee_kelurahan" value="<?php echo $hroemployeedata['employee_kelurahan'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>RW</label>
						<input type="text" name="employee_rw" id="employee_rw" value="<?php echo $hroemployeedata['employee_rw'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label>Kecamatan</label>
						<input type="text" name="employee_kecamatan" id="employee_kecamatan" value="<?php echo $hroemployeedata['employee_kecamatan'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<h3 class="form-section">Contact Person</h3>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Home Phone</label>
						<input type="text" name="employee_home_phone" id="employee_home_phone" value="<?php echo $hroemployeedata['employee_home_phone'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label>Mobile Phone</label>
						<input type="text" name="employee_mobile_phone" id="employee_mobile_phone" value="<?php echo $hroemployeedata['employee_mobile_phone'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="employee_email_address" id="employee_email_address" value="<?php echo $hroemployeedata['employee_email_address'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<h3 class="form-section">Residential Address</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Residence ID</label>
						<input type="text" name="employee_id_number" id="employee_id_number" value="<?php echo $hroemployeedata['employee_id_number'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Residence Address</label>
						<input type="text" name="employee_residence_address" id="employee_residence_address" value="<?php echo $hroemployeedata['employee_residence_address'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Residence City</label>
						<input type="text" name="employee_residence_city" id="employee_residence_city" value="<?php echo $hroemployeedata['employee_residence_city'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label>Residence Zip Code</label>
						<input type="text" name="employee_residence_zip_code" id="employee_residence_zip_code" value="<?php echo $hroemployeedata['employee_residence_zip_code'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Residence RT</label>
						<input type="text" name="employee_residence_rt" id="employee_residence_rt" value="<?php echo $hroemployeedata['employee_residence_rt'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label>Residence Kelurahan</label>
						<input type="text" name="employee_residence_kelurahan" id="employee_residence_kelurahan" value="<?php echo $hroemployeedata['employee_residence_kelurahan'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Residence RW</label>
						<input type="text" name="employee_residence_rw" id="employee_residence_rw" value="<?php echo $hroemployeedata['employee_residence_rw'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label>Residence Kecamatan</label>
						<input type="text" name="employee_residence_kecamatan" id="employee_residence_kecamatan" value="<?php echo $hroemployeedata['employee_residence_kecamatan'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<h3 class="form-section">Driving License</h3>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Driving License A</label>
						<input type="text" name="employee_driving_licenseA" id="employee_driving_licenseA" value="<?php echo $hroemployeedata['employee_driving_licenseA'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label>Driving License B</label>
						<input type="text" name="employee_driving_licenseB" id="employee_driving_licenseB" value="<?php echo $hroemployeedata['employee_driving_licenseB'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Driving License B1</label>
						<input type="text" name="employee_driving_licenseB1" id="employee_driving_licenseB1" value="<?php echo $hroemployeedata['employee_driving_licenseB1'];?>" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
	</div>
</div>