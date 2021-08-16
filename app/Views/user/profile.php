<?= $this->extend('layout/dashboard') ?>
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
							<h3>Dashboard</h3>
						</div>
						<div class="col-auto ms-auto text-end mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">EVote</a></li>
									<li class="breadcrumb-item"><a href="#">Dashboards</a></li>
								</ol>
							</nav>
						</div>
					</div>
				<!-- Main Content -->
				<div class="row">
                <div class="col-12 col-xl-6">
						<?php
		                    if(session()->getFlashdata('message')){
		                ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							<div class="alert-message">
                                <?= session()->getFlashdata('message') ?>
							</div>
						</div>
                        <?php } ?>
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Profile anda</h5>
								</div>
								<?php foreach ($users as $row) { ?>
								<div class="card-body">
									<form method="post" action="<?= base_url('user/changepassword') ?>">
										<div class="mb-3">
											<label class="form-label">Nama</label>
											<input type="text" class="form-control" value="<?= $row->nama ?>" readonly>
										</div>
										<div class="mb-3">
											<label class="form-label">NIM</label>
											<input type="text" class="form-control" value="<?= $row->nim ?>" readonly>
										</div>
										<div class="mb-3">
											<label class="form-label">Password Lama</label>
											<input type="password" name="oldpass" class="form-control" placeholder="Password">
										</div>
										<div class="mb-3">
											<label class="form-label">Password Baru</label>
											<input type="password" name="newpass" class="form-control" placeholder="Password">
										</div>
										<button type="submit" class="btn btn-primary">Simpan</button>
									</form>
								</div>
								<?php } ?>
							</div>
						</div>
				</div>
			</main>
			<?= $this->include('layout/footer') ?>
		</div>
	</div>
<?= $this->endsection() ?>