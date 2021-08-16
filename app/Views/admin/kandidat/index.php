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
							<h3>Daftar Kandidat</h3>
						</div>
						<div class="col-auto ms-auto text-end mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">EVote</a></li>
									<li class="breadcrumb-item"><a href="#">Kandidat</a></li>
								</ol>
							</nav>
						</div>
					</div>
				<!-- Main Content -->
				<div class="row">
                    <div class="col-12">
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
									<a href="<?= base_url('admin/kandidat/tambah') ?>" class="btn btn-primary">+ Tambah</a>
								</div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Pemilihan</th>
                                                <th>Nama Calon atau Pasangan</th>
                                                <th>foto</th>
                                                <th>visi</th>
                                                <th>misi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $i = 1;
                                            foreach ($kandidat as $row) {
                                        ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $row->title ?></td>
                                                <td><?= $row->nama ?></td>
                                                <td>
                                                    <img src="<?= base_url('dist/img/'.$row->image) ?>" alt="foto paslon" style="object-fit:cover" width="154" height="128">
                                                </td>
                                                <td class="overflow-scroll"><?= $row->visi ?></td>
                                                <td class="overflow-scroll" style="height:128px"><?= $row->misi ?></td>
                                                <td class="table-action">
                                                    <a href="<?= base_url('admin/kandidat/edit/'.$row->id) ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                                    <a href="<?= base_url('admin/kandidat/delete/'.$row->id) ?>" onclick="return confirm('Anda yakin ingin menghapusnya?')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
							</div>
						</div>
                    </div>
				</div>
			</main>
			<?= $this->include('layout/footer') ?>
		</div>
	</div>
<?= $this->endsection() ?>