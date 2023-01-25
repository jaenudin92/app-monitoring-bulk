<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-lg-12 mb-4 order-0">
				<div class="card">
					<div class="card-body">
						<button class="btn btn-primary rounded-pill" onclick="addUser()"><i class="bx bx-user-plus"></i> Add User</button>
						<button class="btn btn-secondary rounded-pill" onclick="reloadTableUser()"><i class="bx bx-refresh"></i> Reload</button>
						<!-- <div class="table-responsive text-nowrap"> -->
							<table id="userTable" class="table table-hover table-responsive">
								<thead>
									<tr>
										<th>No</th>
										<th>Fullname</th>
										<th>username</th>
										<th>Level</th>
										<th>Foto</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
							<!-- </div> -->
						</div>
					</div>
				</div>
			</div>
			<!--/ Expense Overview -->
		</div>
	</div>
	<!-- / Content -->

	<!-- Modal -->
	<div class="modal fade" id="modal_form" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="#" id="formuser" class="form-horizontal" enctype="multipart/form-data">
					<div class="modal-body form">
						<input type="hidden" value="" name="id"/> 
						<div class="form-body">
							<div class="mb-3">
								<label for="fullname" class="form-label">Nama Lengkap</label>
								<input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nama Lengkap"/>
								<small id="msg-fullname" class="msg text-danger"></small>
							</div>
							<div class="mb-3">
								<label for="username" class="form-label">Username</label>
								<input type="text" class="form-control" id="username" name="username" placeholder="Username"/>
								<small id="msg-username" class="msg text-danger"></small>
							</div>
							<div class="mb-3">
								<label for="password" id="labelpassword" class="form-label">Password</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="******"/>
								<small id="msg-password" class="msg text-danger"></small>
							</div>
							<div class="mb-3">
								<label for="confirmpassword" id="labelconfirmpassword" class="form-label">Confirmation Password</label>
								<input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="******"/>
								<small id="msg-confirmpassword" class="msg text-danger"></small>
							</div>
							<div class="mb-3">
								<label for="level" class="form-label">Level</label>
								<select name="level" id="level" class="form-control">
									<option value=""> -- Pilih Level -- </option>
									<option value="Leader">Leader</option>
									<option value="Operator">Operator</option>
								</select>
								<small id="msg-level" class="msg text-danger"></small>
							</div>
							<div class="mb-3">
								<label for="foto" id="labelfoto" class="form-label">Image</label>
								<input class="form-control" type="file" id="foto" name="foto" />
								<small id="msg-foto" class="msg text-danger"></small>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" id="btnSave" onclick="saveUser()" class="btn btn-primary rounded-pill">Save</button>
						<button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>


