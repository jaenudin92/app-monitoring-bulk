<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="row">
				<div class="col-xl-12">
					<div class="nav-align-top mb-4">
						<ul class="nav nav-pills mb-3" role="tablist">
							<li class="nav-item">
								<button type="button" class="nav-link rounded-pill active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true">
									Form Input Product
								</button>
							</li>
							<li class="nav-item">
								<button type="button" class="nav-link rounded-pill"  role="tab" data-bs-toggle="tab"  data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false">
									Upload Data Product
								</button>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
								<form action="#" id="forminputproduct" class="form-horizontal">
									<div class="row">
										<div class="col-md-6">
											<div class="mb-3">
												<label for="item_group" class="form-label">Item Group</label>
												<select class="form-control" name="item_group" id="item_group">
													<!-- <option value=""> -- Pilih Item Group -- </option> -->
												</select>
												<small id="msg-item_group" class="msg text-danger"></small>
											</div>
											<div class="mb-3">
												<label for="kode_item" class="form-label">Kode Item</label>
												<input type="text" class="form-control" id="kode_item" name="kode_item" placeholder="Kode Item"/>
												<small id="msg-kode_item" class="msg text-danger"></small>
											</div>
											<div class="mb-3">
												<label for="kode_standar" class="form-label">Kode Standart</label>
												<input type="text" class="form-control" id="kode_standar" name="kode_standar" placeholder="Kode Standart"/>
												<small id="msg-kode_standar" class="msg text-danger"></small>
											</div>
											<div class="mb-3">
												<label for="nama_item" class="form-label">Nama Item</label>
												<input type="text" class="form-control" id="nama_item" name="nama_item" placeholder="Nama Item"/>
												<small id="msg-nama_item" class="msg text-danger"></small>
											</div>
											<div class="mb-3">
												<label for="brand" class="form-label">Brand</label>
												<select class="form-control" name="brand" id="brand">
												</select>
												<small id="msg-brand" class="msg text-danger"></small>
											</div>
											<div class="mb-3">
												<label for="no_batch" class="form-label">No Batch</label>
												<input type="text" class="form-control" id="no_batch" name="no_batch" placeholder="No Batch"/>
												<small id="msg-no_batch" class="msg text-danger"></small>
											</div>
											<div class="mb-3">
												<label for="formula" class="form-label">Formula</label>
												<input type="text" class="form-control" id="formula" name="formula" placeholder="Formula"/>
												<small id="msg-formula" class="msg text-danger"></small>
											</div>
											<div class="mb-3">
												<label for="keterangan" class="form-label">Keterangan</label>
												<input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan"/>
												<small id="msg-keterangan" class="msg text-danger"></small>
											</div>
										</div>
										<div class="col-md-6">
											<div class="mb-3">
												<label for="alokasi" class="form-label">Alokasi</label>
												<input type="text" class="form-control" id="alokasi" name="alokasi" placeholder="Alokasi"/>
												<small id="msg-alokasi" class="msg text-danger"></small>
											</div>
											<div class="mb-3">
												<label for="koordinat" class="form-label">Koordinat</label>
												<select class="form-control" name="koordinat" id="koordinat">
												</select>
												<small id="msg-koordinat" class="msg text-danger"></small>
											</div>
											<div class="mb-3">
												<label for="tgl_berlaku_mulai" class="form-label">Tanggal Berlaku Mulai</label>
												<input type="date" class="form-control" id="tgl_berlaku_mulai" name="tgl_berlaku_mulai" placeholder="Item Group"/>
												<small id="msg-tgl_berlaku_mulai" class="msg text-danger"></small>
											</div>
											<div class="mb-3">
												<label for="tgl_berlaku_sampai" class="form-label">Tanggal Berlaku Selesai</label>
												<input type="date" class="form-control" id="tgl_berlaku_sampai" name="tgl_berlaku_sampai" placeholder="Item Group"/>
												<small id="msg-tgl_berlaku_sampai" class="msg text-danger"></small>
											</div>
											<div class="mb-3">
												<label for="peminjam" class="form-label">Peminjam</label>
												<input type="text" class="form-control" id="peminjam" name="peminjam" placeholder="Peminjam"/>
												<small id="msg-peminjam" class="msg text-danger"></small>
											</div>
											<div class="mb-3">
												<label for="perpanjangan_ke" class="form-label">Perpanjangan Ke</label>
												<input type="number" class="form-control" id="perpanjangan_ke" name="perpanjangan_ke" min="0"/>
												<small id="msg-perpanjangan_ke" class="msg text-danger"></small>
											</div>
											<div class="mb-3">
												<label for="packaging" class="form-label">Packaging</label>
												<select class="form-control" name="packaging" id="packaging">
													<option value=""> -- Pilih Packaging -- </option>
													<option value="Botol">Botol</option>
													<option value="Pot">Pot</option>
													<option value="Asli">Asli</option>
												</select>
												<small id="msg-packaging" class="msg text-danger"></small>
											</div>
											<div class="mb-3">
												<label for="jumlah" class="form-label">Jumlah</label>
												<input type="number" class="form-control" id="jumlah" name="jumlah" min="0"/>
												<small id="msg-jumlah" class="msg text-danger"></small>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="modal-footer">
												<button type="button" id="btnSaveinputproduct" onclick="saveInputproduct()" class="btn btn-primary rounded-pill">Save</button>
												<button type="reset" id="btnResetinputproduct" class="btn btn-secondary rounded-pill">Reset</button>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
								<div class="row">
									<div class="col-md-6">
										<form id="uploadDataProduct" class="form-horizontal">
											<div class="modal-body form">
												<div class="form-group">
													<label for="fileupload">Input File Upload</label>
													<input type="file" class="form-control" name="fileupload">
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" id="btnUploadProduct" onclick="uploadDataProduct()" class="btn btn-primary rounded-pill">Upload</button>
											</div>
										</form>
									</div>
									<div class="col-md-4">
										<p class="text-danger">*Download template upload excel <button class="btn btn-secondary rounded-pill" onclick="downloadTemplate()">Download</button></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ Expense Overview -->
	</div>
</div>
<!-- / Content -->


