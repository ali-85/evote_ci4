<?= $this->extend('layout/dashboard') ?>
<?= $this->section('style') ?>
    <link rel="stylesheet" href="<?= base_url('dist/css/bootstrap-datetimepicker.min.css') ?>">
<?= $this->endsection() ?>
<?= $this->section('content') ?>
	<div class="wrapper">
    <?= $this->include('layout/sidebar') ?>
		<div class="main">
		<?= $this->include('layout/header') ?>
			<main class="content">
				<div class="container-fluid p-0">
					<!-- Breadcrumbs -->
					<div class="row mb-2 mb-xl-3">
						<div class="col-auto d-none d-sm-block">
							<h3>Pengguna</h3>
						</div>
						<div class="col-auto ms-auto text-end mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">EVote</a></li>
									<li class="breadcrumb-item"><a href="#">Pengguna</a></li>
									<li class="breadcrumb-item"><a href="#">Edit</a></li>
								</ol>
							</nav>
						</div>
					</div>
				<!-- Main Content -->
				<div class="row">
                    <div class="col-12 col-lg-6">
                    <form action="<?= base_url('admin/pengguna/update') ?>" method="post">
                        <?php 
                            foreach ($pengguna as $row) { 
                        ?>
						<div class="card">
							<div class="card-header">
								<h5 class="card-title">Edit Pengguna</h5>
							</div>
							<div class="card-body">
                                <input type="hidden" value="<?= $row->id ?>" name="id">
									<div class="mb-3">
										<label class="form-label">NIM</label>
										<input type="number" class="form-control" name="nim" placeholder="NIM" value="<?=$row->nim?>" required>
									</div>
									<div class="mb-3">
										<label class="form-label">Nama</label>
										<input type="text" class="form-control" name="nama" placeholder="Nama" value="<?=$row->nama?>" required>
									</div>
									<div class="mb-3">
										<label class="form-label">Role</label>
										<select name="role" id="role" class="form-control" required>
                                            <option disabled selected>-- Pilih Role --</option>
                                            <option value="0">Pengguna</option>
                                            <option value="1">Admin</option>
                                        </select>
									</div>
									<div class="mb-3">
										<input class="form-check-input" type="checkbox" name="reset" value="1" id="resetPassword">
										<label class="form-label">Atur ulang password pengguna ini?</label>
									</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Simpan</button>
                        <?php } ?>
						</form>
					</div>
				</div>
			</main>
			<?= $this->include('layout/footer') ?>
		</div>
	</div>
<?= $this->endsection() ?>