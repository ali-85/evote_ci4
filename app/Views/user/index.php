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
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
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
									<h5 class="card-title">Voting berjalan</h5>
								</div>
								<div class="card-body">
                                    <ul class="list-group list-group-flush">
								    <?php foreach ($voting as $row) { ?>
                                        <li class="list-group-item">
                                            <?= $row->title ?>
                                            <a href="<?= base_url('user/voting/'.$row->id) ?>" class="btn btn-success float-end">
                                                Lihat Kandidat
                                            </a>
                                        </li>
								    <?php } ?>
                                    </ul>
								</div>
							</div>
						</div>
				</div>
			</main>
			<?= $this->include('layout/footer') ?>
		</div>
	</div>
<?= $this->endsection() ?>