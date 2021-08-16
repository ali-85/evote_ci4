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
							<h3>Voting</h3>
						</div>
						<div class="col-auto ms-auto text-end mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">EVote</a></li>
									<li class="breadcrumb-item"><a href="#">Voting</a></li>
									<li class="breadcrumb-item"><a href="#">Tambah</a></li>
								</ol>
							</nav>
						</div>
					</div>
				<!-- Main Content -->
				<div class="row">
                <div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Tambah Acara</h5>
								</div>
								<div class="card-body">
									<form method="post" action="<?= base_url('admin/voting/tambah/post') ?>">
										<div class="mb-3">
											<label class="form-label">Acara</label>
											<input type="text" class="form-control" name="title" placeholder="Judul Acara">
										</div>
										<div class="mb-3">
                                            <label class="form-label">Mulai</label>
                                            <input type="text" name="started" class="form-control datepicker" autocomplete="off">
										</div>
										<div class="mb-3">
                                            <label class="form-label">Selesai</label>
                                            <input type="text" name="ended" class="form-control datepicker" autocomplete="off">
										</div>
										<button type="submit" class="btn btn-primary">Simpan</button>
									</form>
								</div>
							</div>
						</div>
				</div>
			</main>
			<?= $this->include('layout/footer') ?>
		</div>
	</div>
<?= $this->endsection() ?>
<?= $this->section('script') ?>
    <script src="<?= base_url('dist/js/bootstrap-datetimepicker.js') ?>"></script>
    <script src="<?= base_url('dist/js/bootstrap-datetimepicker.min.js') ?>"></script>
    <script type="text/javascript">
        $(function(){
            $(".datepicker").datetimepicker({
                format: 'yyyy-mm-dd hh:ii',
                autoclose: true,
                todayHighlight: true,
                language:'id'
            });
        });
    </script>
<?= $this->endsection() ?>