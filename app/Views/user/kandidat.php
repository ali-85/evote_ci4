<?= $this->extend('layout/dashboard') ?>
<?= $this->section('style') ?>
	<link rel="stylesheet" href="<?= base_url('dist/css/bootstrap.min.css') ?>">
<?= $this->endsection() ?>
<?= $this->section('content') ?>
	<div class="wrapper">
    <?= $this->include('layout/sidebar') ?>
		<div class="main">
		<?= $this->include('layout/header') ?>
			<main class="content">
				<div class="container-fluid p-0">
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
					<!-- Breadcrumbs -->
					<?php
						foreach ($voting as $vote) {
					?>
					<div class="row mb-2 mb-xl-3">
						<div class="col-auto d-none d-sm-block">
							<h3><?= $vote->title ?></h3>
						</div>
				<!-- Main Content -->
				<div class="row">
						<?php
							foreach ($kandidat as $row) { ?>
						<div class="col-sm-4">
							<div class="card mb-4">
								<div class="card-header">
									<h5 class="card-title mb-0">Detail Kandidat</h5>
								</div>
								<div class="card-body text-center">
									<img src="<?= base_url('/dist/img/'.$row->image) ?>" alt="foto paslon" class="rounded me-2 mb-2" width="154" height="128" style="object-fit:cover">
									<h5 class="card-title mb-0"><?= $row->nama ?></h5>
								</div>
								<hr class="my-0">
								<div class="card-body">
									<h5 class="h6 card-title">Visi</h5>
									<?= $row->visi ?>
								</div>
								<hr class="my-0">
								<div class="card-body">
									<h5 class="h6 card-title">Misi</h5>
									<?= $row->misi ?>
								</div>
								<hr class="my-0">
								<?php
									if (empty($has_vote)) {
										if (date('Y-m-d H:i:s') > $vote->started && date('Y-m-d H:i:s') < $vote->ended) { ?>
								<div class="card-body">
									<a href="<?= base_url('user/voting/'.$vote->id.'/'.$row->id) ?>" class="btn btn-success" onclick="return confirm('Anda yakin memberi suara kepada kandidat <?= $row->nama ?>')">Vote</a>
								</div>
								<?php
										}	
									} else {
								?>
								<ul class="list-group list-group-flush">
									<li class="list-group-item px-4 pb-4">
										<p class="mb-2 font-weight-bold">Perolehan Suara <span class="float-end"><?= number_format(0+$row->vote/$total*100,2) ?>%</span></p>
										<div class="progress">
											<div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?= number_format($row->vote/$total*100) ?>%" aria-valuenow="<?= number_format(0+$row->vote/$total*100) ?>" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</li>
								</ul>
								<?php } ?>
							</div>
						</div>
							<?php } ?>
					</div>
				</div>
				<?php } ?>
			</main>
			<?= $this->include('layout/footer') ?>
		</div>
	</div>
<?= $this->endsection() ?>