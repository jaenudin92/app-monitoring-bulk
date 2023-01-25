<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-lg-12 mb-4 order-0">
				<div class="card">
					<div class="card-body">
						<!-- <form class="mb-4" method="POST"> -->
							<div class="form-body">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="item_group">Item Group</label>
											<select name="item_group" id="item_group" class="form-control">
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="brand">Brand</label>
											<select name="brand" id="brand" class="form-control">
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="status">Status</label>
											<select name="status" id="status" class="form-control">
												<option value=""> -- Pilih Status --</option>
												<option value="Aktif">Aktif</option>
												<option value="Warning">Warning</option>
												<option value="Expired">Expired</option>
												<option value="Non Aktif">Non Aktif</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row mt-4">
									<div class="col-md-3">
										<div class="form-group">
											<label for="datefrom">Tgl Expired Dari</label>
											<input type="date" id="datefrom" name="datefrom" class="form-control">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="dateto">Tgl Expired Sampai</label>
											<input type="date" id="dateto" name="dateto" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<button class="btn btn-primary rounded-pill mt-4" onclick="searchTableProduct()"> Search</button>
										<button class="btn btn-success rounded-pill mt-4" onclick="exportTableProduct()" style="margin-left:10px"> Export to Excel</button>
										<button class="btn btn-secondary rounded-pill mt-4" style="margin-left:10px" onclick="reloadTableProduct()"> Reset Filter</button>
									</div>
								</div>
							</div>
							<!-- </form> -->
							<hr>
							<div class="text-nowrap">
								<table id="productTable" class="table table-hover table-responsive">
									<thead>
										<tr>
											<th>Action</th>
											<th>Item Group</th>
											<th>Kode Item</th>
											<th>Kode Standar</th>
											<th>Nama Item</th>
											<th>Brand</th>
											<th>No Batch</th>
											<th>Formula</th>
											<th>Keterangan</th>
											<th>Alokasi</th>
											<th>Koordinat</th>
											<th>Tgl Berlaku Mulai</th>
											<th>Tgl Berlaku Sampai</th>
											<th>Peminjam</th>
											<th>Perpanjangan Ke</th>
											<th>Packaging</th>
											<th>Jumlah</th>
											<th>Expired</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ Expense Overview -->
		</div>
	</div>
	<!-- / Content -->

	<!-- Modal -->
	<div class="modal fade" id="modal_form_edit_product" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalCenterTitle">Ubah Data Product</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="#" id="formeditproduct" class="form-horizontal">
					<div class="modal-body form">
						<input type="hidden" value="" name="id"/>
						<div class="form-body">
							<div class="mb-3">
								<label for="tglmulai" class="form-label">Tgl Berlaku Mulai </label>
								<input type="date" class="form-control" id="tglmulai" name="tglmulai"/>
								<small id="msg-tglmulai" class="msg text-danger"></small>
							</div>
							<div class="mb-3">
								<label for="tglsampai" class="form-label">Tgl Berlaku Sampai </label>
								<input type="date" class="form-control" id="tglsampai" name="tglsampai"/>
								<small id="msg-tglsampai" class="msg text-danger"></small>
							</div>
							<div class="mb-3">
								<label for="perpanjangan" class="form-label">Perpanjangan Ke </label>
								<input type="number" class="form-control" id="perpanjangan" name="perpanjangan" min="0" />
								<small id="msg-perpanjangan" class="msg text-danger"></small>
							</div>
							<div class="mb-3">
								<label for="jmlh" class="form-label">Jumlah </label>
								<input type="number" class="form-control" id="jmlh" name="jmlh" min="0"/>
								<small id="msg-jmlh" class="msg text-danger"></small>
							</div>
							<small class="text-light fw-semibold">Status Product</small>
							<div class="form-check mt-3">
								<input name="statusproduct" class="form-check-input" type="radio" value="Aktif" id="radioStatusAktif"/>
								<label class="form-check-label" for="radioStatusAktif"> Aktif </label>
							</div>
							<div class="form-check">
								<input name="statusproduct" class="form-check-input" type="radio" value="Non Aktif" id="radioStatusNonAktif"/>
								<label class="form-check-label" for="radioStatusNonAktif"> Non Aktif </label>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" id="btnUpdateProduct" onclick="updateProduct()" class="btn btn-primary rounded-pill">Update</button>
						<button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>


