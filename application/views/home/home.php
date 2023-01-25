<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-md-4 mb-4">
				<div class="card bg-danger">
					<div class="card-body">
						<div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
							<div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
								<div class="card-title">
									<h5 class="text-nowrap mb-1 text-white"> Expired</h5>
								</div>
								<div class="mt-sm-auto">
									<h1 class="mb-3 text-white"><?= $totalexpired; ?></h1>
									<a href="javascript:void(0)" onclick="informasiExpired()" class="badge bg-label-warning rounded-pill text-dark">Lihat Informasi</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-4">
				<div class="card bg-warning">
					<div class="card-body">
						<div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
							<div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
								<div class="card-title">
									<h5 class="text-nowrap mb-1 text-white">Masa Expired < <?= $masaexp; ?> Hari</h5>
								</div>
								<div class="mt-sm-auto">
									<h1 class="mb-3 text-white"><?= $totalwarning; ?></h1>
									<a href="javascript:void(0)" onclick="informasiWarning()" class="badge bg-label-warning rounded-pill text-dark">Lihat Informasi</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-4">
				<div class="card bg-secondary">
					<div class="card-body">
						<div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
							<div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
								<div class="card-title">
									<h5 class="text-nowrap mb-1 text-white">Non Aktif</h5>
								</div>
								<div class="mt-sm-auto">
									<h1 class="mb-3 text-white"><?= $totalnonaktif; ?></h1>
									<a href="javascript:void(0)" onclick="informasiNonAktif()" class="badge bg-label-warning rounded-pill text-dark">Lihat Informasi</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!--/ Expense Overview -->
		<div class="card" id="cardInformasiExpired">
			<div class="card-body text-nowrap">
				<table class="table table-responsive tableInformasi">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Item</th>
							<th>Kode Standar</th>
							<th>Koordinat</th>
							<th>Jumlah</th>
							<th>Packaging</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($dataexpired as $key => $value) : ?>
							<tr class="bg-danger text-white">
								<td><?= $no++; ?></td>
								<td><?= $value->kode_item; ?></td>
								<td><?= $value->kode_standar; ?></td>
								<td><?= $value->koordinat; ?></td>
								<td><?= $value->jumlah; ?></td>
								<td><?= $value->packaging; ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="card d-none" id="cardInformasiWarning">
			<div class="card-body text-nowrap ">
				<table class="table table-responsive tableInformasi">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Item</th>
							<th>Kode Standar</th>
							<th>Koordinat</th>
							<th>Jumlah</th>
							<th>Packaging</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($datawarning as $key => $value) : ?>
							<tr class="bg-warning text-white">
								<td><?= $no++; ?></td>
								<td><?= $value->kode_item; ?></td>
								<td><?= $value->kode_standar; ?></td>
								<td><?= $value->koordinat; ?></td>
								<td><?= $value->jumlah; ?></td>
								<td><?= $value->packaging; ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="card d-none" id="cardInformasiNonAktif">
			<div class="card-body text-nowrap">
				<table class="table table-responsive tableInformasi">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Item</th>
							<th>Kode Standar</th>
							<th>Koordinat</th>
							<th>Jumlah</th>
							<th>Packaging</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($datanonaktif as $key => $value) : ?>
							<tr class="bg-secondary text-white">
								<td><?= $no++; ?></td>
								<td><?= $value->kode_item; ?></td>
								<td><?= $value->kode_standar; ?></td>
								<td><?= $value->koordinat; ?></td>
								<td><?= $value->jumlah; ?></td>
								<td><?= $value->packaging; ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- / Content -->