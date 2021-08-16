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
							<h3>Import</h3>
						</div>
						<div class="col-auto ms-auto text-end mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">EVote</a></li>
									<li class="breadcrumb-item"><a href="#">Pengguna</a></li>
									<li class="breadcrumb-item"><a href="#">Import</a></li>
								</ol>
							</nav>
						</div>
					</div>
				<!-- Main Content -->
				<div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Import Excel</h5>
                            </div>
                            <div class="card-body">
                            <form action="<?= base_url('admin/import/post') ?>" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
									<label class="form-label w-100">.csv .xlsx</label>
									<input type="file" name="excelfile" required>
									<small class="form-text text-muted">Buka atau tarik file kesini!</small>
								</div>
                                <button type="submit" class="btn btn-success">Kirim</button>
                            </div>
                            </form>
                        </div>
                    </div>
				</div>
			</main>
			<?= $this->include('layout/footer') ?>
		</div>
	</div>
<?= $this->endsection() ?>