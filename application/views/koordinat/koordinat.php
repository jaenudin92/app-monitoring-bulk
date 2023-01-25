<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-lg-12 mb-4 order-0">
				<div class="card">
					<div class="card-body">
						<button class="btn btn-primary rounded-pill" onclick="addKoordinat()"><i class="bx bx-plus"></i> Add Koordinat</button>
						<button class="btn btn-secondary rounded-pill" onclick="reloadTableKoordinat()"><i class="bx bx-refresh"></i> Reload</button>
						<!-- <div class="table-responsive text-nowrap"> -->
							<table id="koordinatTable" class="table table-hover table-responsive">
								<thead>
									<tr>
										<th>No</th>
										<th>Koordinat</th>
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
	<div class="modal fade" id="modal_form_koordinat" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="#" id="formkoordinat" class="form-horizontal" enctype="multipart/form-data">
					<div class="modal-body form">
						<input type="hidden" value="" name="id"/> 
						<div class="form-body">
							<div class="mb-3">
								<label for="koordinat" class="form-label">Koordinat</label>
								<input type="text" class="form-control" id="koordinat" name="koordinat" placeholder="Item Group"/>
								<small id="msg-koordinat" class="msg text-danger"></small>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" id="btnSavekoordinat" onclick="saveKoordinat()" class="btn btn-primary rounded-pill">Save</button>
						<button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>


